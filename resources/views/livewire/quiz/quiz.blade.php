<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};

new 
#[Layout('components.layouts.quiz')] 
class extends Component {
public $slug;
public $token ;

public $quiz;
   

    function mount($slug):void
    {

        $this->quiz= Quiz::whereSlug($this->slug)->firstOrFail();

        // store session inacase user returns to umcompleted quitions

    }

    //
}; ?>

<div>


    <x-quiz.start />
</div>
