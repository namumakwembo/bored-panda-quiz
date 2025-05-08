<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout};
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Outcome;
use Illuminate\Support\Str;

new #[Layout('components.layouts.quiz')]
class extends Component
{
    public $slug;
    public $quiz;
    public $questions = [];
    public bool $start = true;
    public $currentQuestionIndex = 0;
    public $answers = []; // Store answers as [question_id => outcome_id]
    public $currentQuestion;
    public $selectedOption = null;

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->quiz = Quiz::where('slug', $slug)->firstOrFail();

        // Load questions
        $this->loadQuestions();

        // Set initial question
        $this->updateCurrentQuestionAndOptions();
    }

    /**
     * Start the quiz.
     */
    public function startQuiz(): void
    {
        $this->start = false;
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
     * Save the selected option's outcome_id to the answers array.
     */
    public function saveAnswer(): void
    {
        if ($this->selectedOption) {
            $questionId = array_keys($this->questions)[$this->currentQuestionIndex];
            // Find the option to get its outcome_id
            $option = Option::find($this->selectedOption);
            if ($option && $option->question_id == $questionId && $option->outcome_id) {
                $this->answers[$questionId] = $option->outcome_id;
                \Log::info('Saved Answer: ', [
                    'question_id' => $questionId,
                    'option_id' => $this->selectedOption,
                    'outcome_id' => $option->outcome_id
                ]);
            } else {
                \Log::warning('Invalid Option Selected: ', [
                    'option_id' => $this->selectedOption,
                    'question_id' => $questionId
                ]);
            }
        }
    }

    /**
     * Go to the previous question.
     */
    public function prevQuestion(): void
    {
        if ($this->currentQuestionIndex > 0) {
            $this->saveAnswer();
            $this->currentQuestionIndex--;
            $this->updateCurrentQuestionAndOptions();
        }
    }

    /**
     * Go to the next question or complete the quiz.
     */
    public function nextQuestion(): void
    {
        if (!$this->selectedOption) {
            $this->addError('selectedOption', 'Please select an option.');
            return;
        }

        $this->saveAnswer();

        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->updateCurrentQuestionAndOptions();
        } else {
            $this->completeQuiz();
        }
    }

    /**
     * Complete the quiz and redirect to the results page.
     */
    public function completeQuiz(): void
    {
        if (!$this->selectedOption) {
            $this->addError('selectedOption', 'Please select an option.');
            return;
        }

        $this->saveAnswer();

        // Evaluate answers to find the most frequent outcome
        $results = $this->evaluateAnswers();

        // Redirect to results page with the winning outcome_id
        $this->redirect(route('quiz.result', [
            'slug' => $this->slug,
            'outcome_id' => $results['outcome_id'],
        ]), navigate: true);
    }

    /**
     * Evaluate the answers to find the most frequent outcome.
     */
    private function evaluateAnswers(): array
    {
        $results = [
            'total_questions' => count($this->questions),
            'answered_questions' => count($this->answers),
            'outcome_id' => null,
        ];

        // Count occurrences of each outcome_id
        $outcomeCounts = [];
        foreach ($this->answers as $questionId => $outcomeId) {
            $outcomeCounts[$outcomeId] = ($outcomeCounts[$outcomeId] ?? 0) + 1;
        }

        // Find the outcome_id with the most occurrences
        if (!empty($outcomeCounts)) {
            $results['outcome_id'] = array_keys($outcomeCounts, max($outcomeCounts))[0];
        } else {
            // Fallback: Select a random outcome if no answers
            $outcome = Outcome::where('quiz_id', $this->quiz->id)->first();
            $results['outcome_id'] = $outcome->id ?? null;
        }

        \Log::info('Evaluated Results: ', $results);

        return $results;
    }

    /**
     * Update current question and selected option.
     */
    private function updateCurrentQuestionAndOptions(): void
    {
        $this->currentQuestion = $this->getCurrentQuestionProperty();
        $currentQuestionId = array_keys($this->questions)[$this->currentQuestionIndex] ?? null;
        // Find the option_id that corresponds to the saved outcome_id
        $this->selectedOption = null;
        if (isset($this->answers[$currentQuestionId])) {
            $option = Option::where('question_id', $currentQuestionId)
                ->where('outcome_id', $this->answers[$currentQuestionId])
                ->first();
            $this->selectedOption = $option->id ?? null;
        }
        \Log::info('Updated Selected Option: ', [
            'question_id' => $currentQuestionId,
            'selected_option' => $this->selectedOption,
            'outcome_id' => $this->answers[$currentQuestionId] ?? null
        ]);
        $this->resetErrorBag('selectedOption');
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
     * Get options for the current question, including outcome_id.
     */
    public function getCurrentOptionsProperty()
    {
        if (!$this->currentQuestion) {
            return [];
        }
        return Option::where('question_id', $this->currentQuestion['id'])
            ->get()
            ->map(function ($option) {
                return [
                    'id' => $option->id,
                    'text' => $option->text,
                    'outcome_id' => $option->outcome_id,
                ];
            })
            ->toArray();
    }
}
?>
<div class="max-w-2xl mx-auto p-4">
    @if ($start)
        <x-quiz.start :quiz="$quiz" wire:click="startQuiz" />
    @else
        <x-quiz.question 
            :quiz="$quiz" 
            :questions="$questions" 
            :question="$this->getCurrentQuestionProperty()" 
            :currentQuestionIndex="$currentQuestionIndex" 
            :selectedOption="$this->selectedOption" 
            :options="$this->getCurrentOptionsProperty()" 
        />
    @endif
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('update-token', (token) => {
            document.cookie = `quiz_token=${token}; path=/`;
        });
    });
</script>
@endscript