<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="max-w-2xl mx-auto p-4">
        @if ($start)
            <x-quiz.start :quiz="$quiz" wire:click="startQuiz" />
        @else
            <x-quiz.question :quiz="$quiz" :questions="$questions" :question="$this->getCurrentQuestionProperty()" :currentQuestionIndex="$currentQuestionIndex" :options="$this->getCurrentOptionsProperty()" />
        @endif
    </div>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('update-token', (token) => {
                document.cookie = `quiz_token=${token}; path=/`;
            });
        });
    </script>
</div>
