<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Quiz;
use App\Models\QuizSession;
new #[Layout('components.layouts.quiz')] class extends Component {
    public $token;
    //public $quizzes;

    /**
     * Redirect to a quiz, reusing an existing session token if available.
     */
    public function chooseQuiz(string $slug): void
    {
        $quiz = Quiz::where('slug', $slug)->firstOrFail();

        // Check for existing token in cookie
        $cookieToken = request()->cookie('quiz_token');

        // Check for existing incomplete session
        $session = $cookieToken
            ? QuizSession::where('quiz_id', $quiz->id)
                ->where('token', $cookieToken)
                ->where('completed', false)
                ->first()
            : null;

        // Use existing token or create a new one
        $token = $session ? $session->token : Str::random(32);

        if (!$session) {
            $session = QuizSession::create([
                'quiz_id' => $quiz->id,
                'token' => $token,
                'completed' => false,
            ]);
        }

        // Store token in cookie (7-day expiry)
        cookie()->queue('quiz_token', $token, 60 * 24 * 7);

        // Redirect to quiz with token
        $this->redirect(route('quiz.show', ['slug' => $slug, 'token' => $token]));
    }


    public function with(): array
    {
        return [
            'quizzes' =>Quiz::all()
        ];
    }
}; ?>

<div>

    <x-quiz.quizzes :quizzes="$quizzes" />
</div>
