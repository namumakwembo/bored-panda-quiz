<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout};
use App\Models\Quiz;
use App\Models\Outcome;
use Livewire\Attributes\Url;

new #[Layout('components.layouts.quiz')]
class extends Component
{
    public $slug;
    #[Url]
    public $outcome_id;
    public $quiz;
    public $outcome;

    public function mount($slug, $outcome_id): void
    {
        $this->slug = $slug;
        $this->outcome_id = $outcome_id;
        $this->quiz = Quiz::where('slug', $this->slug)->firstOrFail();
        $this->outcome = Outcome::where('id', $this->outcome_id)
            ->where('quiz_id', $this->quiz->id)
            ->firstOrFail();
    }
};
?>

<div class="max-w-xl w-full mx-auto p-4 border  rounded-lg h-full min-h-full">


    <div class="space-y-3">
        <h2 class="text-3xl font-bold">Party Results 🎉</h2>
        <h4 class="font-medium text-lg">{{ $this->quiz->title }}</h4>
    </div>

    <div class="bg-white p-6 mt-10 h-96 flex flex-col rounded-2xl shadow-sm text-center ">
        <h2 class="text-xl font-bold mb-4 underline text-gray-700 dark:text-white">You got:</h2>
        <h2 class="text-4xl font-bold mb-4 animate-pulse">{{ $outcome->title }}</h2>
        <p class="text-gray-700 ">{{ $outcome->description }}</p>
        <div class="grid grid-cols-2 mt-auto gap-5">

            <flux:button href="{{ route('quiz') }}" class="w-full">

                {{ __('  Back to Quizzes') }}
            </flux:button>

            <flux:button     icon:trailing="arrow-path" href="{{ route('quiz.show', ['slug' => $quiz->slug]) }}" variant="primary" class="w-full">

                {{ __('  Take Again') }}
            </flux:button>

        </div>
    </div>
</div>
