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


        $this->redirect(route('quiz.show', ['slug' => $slug]));
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
