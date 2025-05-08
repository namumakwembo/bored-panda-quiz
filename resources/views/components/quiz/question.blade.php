<!-- resources/views/components/quiz/question.blade.php -->
@props(['quiz', 'question', 'options','currentQuestionIndex','questions'])


<div class="max-w-xl mx-auto flex flex-col gap-y-4">
    {{-- Questions --}}
    <label class="text-3xl">
        {{ $question['text'] }}
    </label>

    {{-- Options --}}
    <div class="space-y-2">
        @foreach ($options as $option)

            <label class="flex items-center mb-4">
                <input wire:model="selectedOption"  type="radio" value="{{ $option['id'] }}" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $option['text'] }}</span>
            </label>
        @endforeach
    </div>

    {{-- Actions --}}
    <div>
        <div class="grid grid-cols-2 gap-5 w-full">
            <flux:button
                outline
                type="button"
                wire:click="prevQuestion"
                class="w-full"
                :disabled="$currentQuestionIndex === 0"
            >
                {{ __('Prev') }}
            </flux:button>

            @if ($currentQuestionIndex < count($questions) - 1 )
            <flux:button
            icon:trailing="chevron-right"
            wire:click="nextQuestion"
            variant="primary"
            type="sumit"
            class="w-full">
            {{ __('Next') }}
        </flux:button>
            @else
            <flux:button

            wire:click="completeQuiz"
            variant="primary"
            type="sumit"
            class="w-full">

            {{  __('Complete') }}
        </flux:button>
        
            @endif
        </div>
    </div>

    @error('selectedOption')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>