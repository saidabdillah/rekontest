<?php

namespace App\Livewire\Messages;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Livewire\Component;

class Index extends Component
{
    public $notifications;
    public function mount()
    {
        $this->notifications = DatabaseNotification::all();
    }

    public function render()
    {
        return view('livewire.messages.index');
    }
}
