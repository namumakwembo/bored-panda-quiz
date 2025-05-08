<!-- resources/views/components/quiz/question.blade.php -->
@props(['quiz', 'question', 'options', 'currentQuestionIndex', 'questions','selectedOption'])

<div x-data="{ selected: @entangle('selectedOption').live }" class="w-full  mx-auto  flex flex-col gap-y-4">
    {{-- Questions --}}
    <label class="text-3xl">
        {{ $question['text'] }}
    </label>

    {{-- Options --}}
    <div class="space-y-2 w-full">
        @foreach ($options as $option)
            <label 
                class="flex items-center mb-4 cursor-pointer" 
                :class="{ 'bg-blue-100 border-blue-300 dark:bg-gray-700': selected == '{{ $option['id'] }}' }"
            >
                <input 
                    wire:model.live="selectedOption" 
                    type="radio" 
                    value="{{ $option['id'] }}" 
                    name="option" 
                    x-bind:checked="selected == '{{ $option['id'] }}'"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <span class="ms-2 text-base font-medium text-gray-900 dark:text-gray-300">{{ $option['text'] }}</span>
            </label>
        @endforeach
    </div>

    {{-- Actions --}}
    <div class="w-full">
        <div class="grid sm:grid-cols-2 gap-5 w-full">
            <flux:button
                outline
                type="button"
                wire:click="prevQuestion"
                class="w-full"
                :disabled="$currentQuestionIndex === 0"
            >
                {{ __('Prev') }}
            </flux:button>

            @if ($currentQuestionIndex < count($questions) - 1)
                <flux:button
                    icon:trailing="chevron-right"
                    wire:click="nextQuestion"
                    variant="primary"
                    type="button"
                    class="w-full"
                >
                    {{ __('Next') }}
                </flux:button>
            @else
                <flux:button
                    wire:click="completeQuiz"
                    variant="primary"
                    type="button"

                    class="w-full bg-green-600 hover:bg-green-800 transition-colors text-white"
                >
                    {{ __('Complete') }}
                </flux:button>
            @endif
        </div>
    </div>

    @error('selectedOption')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror

</div>