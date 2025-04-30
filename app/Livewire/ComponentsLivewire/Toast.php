<?php

namespace App\Livewire\ComponentsLivewire;

use Livewire\Component;

class Toast extends Component
{
    public $message;

    public function mount($message = '')
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.components-livewire.toast');
    }
}
