<?php

namespace App\Livewire;

use Livewire\Attributes\{Layout};
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuizSession;
use App\Models\QuizAnswer;
use Illuminate\Support\Str;
use Livewire\Component;


class Show extends Component
{
    public $slug;
    public $token;
    public $quiz;
    public $questions = [];
    public bool $start = true;
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $currentQuestion;
    public $currentOptions;
    public $session;
    public $selectedOption = null;

    public function mount($slug, $token = null): void
    {
        $this->slug = $slug;
        $this->token = $token;
        $this->quiz = Quiz::where('slug', $slug)->firstOrFail();

        // Initialize or resume session
        $this->initializeSession();

        // Load questions and answers
        $this->loadQuestions();
        $this->loadAnswers();

        $this->currentQuestion=$this->getCurrentQuestionProperty();
    }

    /**
     * Start the quiz.
     */
    public function startQuiz(): void
    {
        $this->start = false;
    }

    /**
     * Initialize or resume a quiz session.
     */
    private function initializeSession(): void
    {
        if ($this->token) {
            $this->session = QuizSession::where('token', $this->token)
                ->where('quiz_id', $this->quiz->id)
                ->first();
        }

        if (!$this->session || $this->session?->completed) {
            $this->session = QuizSession::create([
                'quiz_id' => $this->quiz->id,
                'token' => Str::uuid(),
                'completed' => false,
            ]);
            $this->token = $this->session->token;
        }

        // Store token in cookie
        $this->dispatch('update-token', $this->token);
    }

    /**
     * Load quiz questions.
     */
    private function loadQuestions(): void
    {
        $this->questions = Question::where('quiz_id', $this->quiz->id)
            ->orderBy('order')
            ->get()
            ->mapWithKeys(function ($question) {
                return [$question->id => ['id' => $question->id, 'text' => $question->text]];
            })
            ->toArray();


    }

    /**
     * Load previous answers for the session.
     */
    private function loadAnswers(): void
    {
        $this->answers = QuizAnswer::where('quiz_session_id', $this->session->id)
            ->pluck('option_id', 'question_id')
            ->toArray();

        // Set selected option for the current question
        $currentQuestionId = array_keys($this->questions)[$this->currentQuestionIndex] ?? null;
        $this->selectedOption = $this->answers[$currentQuestionId] ?? null;

        // Set current question index to the first unanswered question
        $answeredQuestionIds = array_keys($this->answers);
        $this->currentQuestionIndex = 0;
        $questionIds = array_keys($this->questions);
        foreach ($questionIds as $index => $questionId) {
            if (!in_array($questionId, $answeredQuestionIds)) {
                $this->currentQuestionIndex = $index;
                break;
            }
        }

        // If all questions are answered, redirect to outcome
        if (count($this->answers) === count($this->questions)) {
            $this->start = false;
            $this->redirectToOutcome();
        }
    }

    /**
     * Save the selected option as an answer.
     */
    public function saveAnswer(): void
    {
        if (!$this->selectedOption) {
            return;
        }

        $option = Option::findOrFail($this->selectedOption);
        $questionId = array_keys($this->questions)[$this->currentQuestionIndex];

        // Save or update answer
        QuizAnswer::updateOrCreate(
            [
                'quiz_session_id' => $this->session->id,
                'question_id' => $questionId,
            ],
            [
                'option_id' => $this->selectedOption,
            ]
        );

        // Update answers array
        $this->answers[$questionId] = $this->selectedOption;
    }

    /**
     * Go to the previous question.
     */
    public function prevQuestion(): void
    {
        if ($this->currentQuestionIndex > 0) {
            $this->saveAnswer(); // Save current answer before moving
            $this->currentQuestionIndex--;
            $currentQuestionId = array_keys($this->questions)[$this->currentQuestionIndex];
            $this->selectedOption = $this->answers[$currentQuestionId] ?? null;
        }
    }

    /**
     * Go to the next question or complete the quiz.
     */
    public function nextQuestion(): void
    {
        dd('firing');
        if (!$this->selectedOption) {
            $this->addError('selectedOption', 'Please select an option.');
            return;
        }

        $this->saveAnswer();

        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $currentQuestionId = array_keys($this->questions)[$this->currentQuestionIndex];
            $this->selectedOption = $this->answers[$currentQuestionId] ?? null;
        } else {
            $this->completeQuiz();
        }
    }

    /**
     * Complete the quiz and redirect to the outcome page.
     */
    public function completeQuiz(): void
    {
        if (!$this->selectedOption) {
            $this->addError('selectedOption', 'Please select an option.');
            return;
        }

        $this->saveAnswer();
        $this->session->update(['completed' => true]);
        $this->redirectToOutcome();
    }

    /**
     * Redirect to the outcome page.
     */
    private function redirectToOutcome(): void
    {
        $this->redirect(route('quiz.result', ['slug' => $this->slug, 'token' => $this->token]), navigate: true);
    }

    /**
     * Get the current question.
     */
    public function getCurrentQuestionProperty()
    {
        return count($this->questions) > 0
            ? $this->questions[array_keys($this->questions)[$this->currentQuestionIndex]]
            : null;
    }

    /**
     * Get options for the current question.
     */
    public function getCurrentOptionsProperty()
    {
        if (!$this->currentQuestion) {
            return [];
        }
        return Option::where('question_id', $this->currentQuestion['id'])
            ->get()
            ->map(function ($option) {
                return ['id' => $option->id, 'text' => $option->text];
            })
            ->toArray();
    }

    function test()  {
       dd( 'here');
        
    }

   


    public function render()
    {
        return view('livewire.show',[
            'quiz' => $this->quiz,
            'currentQuestion' => $this->getCurrentQuestionProperty(),
            'currentOptions' => $this->getCurrentOptionsProperty(),
            'currentQuestionIndex'=>$this->currentQuestionIndex
        ])->layout('components.layouts.quiz');
    }
}
