@props(['quiz'])

<div class=" max-w-xl mx-auto  space-y-12">

    <div class="space-y-2">
        <h2 class="text-4xl font-bold">Let’s get this party started!</h2>
        <p>Take this quiz with friends in real time and compare results.</p>
    </div>

    <div class="grid grid-cols-12  border rounded-2xl gap-3  p-3">

        <img src="{{ $quiz->image }}" alt="" class="col-span-4 h-32 w-full  rounded-xl">


        <div class=" col-span-8 text-2xl font-bold p-3 ">
          {{ $quiz->title }}
        </div>

    </div>

    <div>
        <flux:button wire:click="$set('start',true)" variant="primary" type="submit" class="w-full">{{ __('Next') }}</flux:button>
    </div>


 
</div>