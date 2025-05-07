<?php

namespace App\Livewire\ComponentsLivewire;

use Livewire\Component;

class Toast extends Component
{
    public $type;
    public $message;

    public function mount($type = '', $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.components-livewire.toast');
    }
}
