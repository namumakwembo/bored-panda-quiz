@props(['quiz'])



<div class=" max-w-xl mx-auto  flex flex-col gap-y-4">

    {{-- questions --}}
    <label for="" class="text-3xl">
        Let’s get this party started?
    </label>

    {{-- options --}}
    <flux:radio wire:model="option" label="option" />

    {{-- actions --}}
    <div>
        <div class="grid grid-cols-2 gap-5 w-full">

            <flux:button outline type="button" class="w-full">{{ __('Prev') }}</flux:button>

            <flux:button icon:trailing="chevron-right" wire:click="$set('start',true)" variant="primary" type="button"
                class="w-full">{{ __('Next') }}</flux:button>
        </div>
    </div>

</div>
