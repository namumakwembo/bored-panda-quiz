<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Quiz;
new 
#[Layout('components.layouts.quiz')] 
class extends Component {
public $slug;
public $token ;

public $quiz;

public $questions=[];

public bool $start = true;
   

    function mount($slug):void
    {
        $this->quiz= Quiz::whereSlug($this->slug)->firstOrFail();
    }

};
?>

<div>


    @if ($this->start)
    
    <x-quiz.questions :quiz="$this->quiz" />

    @else
     <x-quiz.start :quiz="$this->quiz" />
    @endif
</div>
