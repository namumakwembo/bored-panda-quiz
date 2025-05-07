@props(['quizzes'])

<div class=" max-w-7xl mx-auto">

    <ul class="grid grid-cols-2 gap-5">

        @foreach ($quizzes as $item)
            <li  wire:click="chooseQuiz('{{ $item->slug }}')" class="h-80  border relative flex justify-center items-center cursor-pointer overflow-hidden rounded-xl  group">

                <img class="h-full w-full  object-cover" src="{{ $item->image }}" alt="image">

                <div class="absolute inset-auto m-auto gap-5 max-w-[85%] z-10 text-white flex group-hover:scale-105 transition-all flex-col items-center justify-center ">
                <h3 class="text-4xl lg:text-4xl font-bold">{{ $item->title }}</h3>
                <p class="mx-auto  flex items-center justify-center text-gray-100 max-w-lg">{{ $item->description }}</p>
                
                </div>
                <span class="absolute inset-0 bg-black opacity-55 group-hover:opacity-50  transition-all"></span>
            </li>
        @endforeach

    </ul>
</div>