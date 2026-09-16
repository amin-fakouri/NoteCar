<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Landing extends Component
{
    #[Layout('components.landing-cmpn')]
    public function render()
    {
        return view('livewire.landing');
    }
}
