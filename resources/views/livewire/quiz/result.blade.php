<!-- app/Livewire/QuizResultComponent.php -->
<?php
use Livewire\Volt\Component;
use Livewire\Attributes\{Layout};
use App\Models\Quiz;
use App\Models\QuizSession;
use App\Models\QuizAnswer;
use App\Models\Option;
use Livewire\Attributes\Url;
new #[Layout('components.layouts.quiz')] class extends Component {
    public $slug;
    #[Url]
    public string $token;
    public $quiz;
    public $session;
    public $outcome;

    public function mount(): void
    {
        $this->quiz = Quiz::where('slug', $this->slug)->firstOrFail();
        $this->session = QuizSession::where('token', $this->token)->where('quiz_id', $this->quiz->id)->firstOrFail();
        $this->calculateOutcome();
    }

    private function calculateOutcome(): void
    {
        $answers = QuizAnswer::where('quiz_session_id', $this->session->id)->pluck('option_id')->toArray();
        $outcomes = Option::whereIn('id', $answers)->with('outcome')->get()->groupBy('outcome.key')->map->count();
        $dominantOutcome = $outcomes->sortDesc()->keys()->first();
        $this->outcome = $this->quiz->outcomes()->where('key', $dominantOutcome)->first();
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
