@props(['quizzes'])

<div class="w-full xl:max-w-7xl mx-auto">

    <ul class="grid sm:grid-cols-2 gap-5">

        @foreach ($quizzes as $item)
            <li  wire:click="chooseQuiz('{{ $item->slug }}')" class="h-80  border dark:border-zinc-700 relative flex flex-col justify-center items-center cursor-pointer overflow-hidden rounded-xl  group">

                <img class="h-full w-full  object-cover" src="{{ $item->image }}" alt="image">

                <div class="absolute inset-auto m-auto  gap-5 max-w-[85%] z-10 text-white/90 group-hover:text-white transition-all flex group-hover:scale-105 transition-all flex-col items-center justify-center ">
                <h3 class="text-3xl lg:text-4xl font-bold">{{ $item->title }}</h3>
                <p class="mx-auto  flex items-center justify-center text-gray-200 group-hover:text-white transition-all max-w-lg">{{ $item->description }}</p>
                
                <flux:button  variant="primary" type="button" class="w-fit mt-5">{{ __('Start') }}</flux:button>
                </div>


                <span class="absolute inset-0 bg-black opacity-55 group-hover:opacity-50  transition-all"></span>
            </li>
        @endforeach

    </ul>
</div>