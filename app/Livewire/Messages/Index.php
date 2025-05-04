<?php

namespace App\Livewire\Messages;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Index extends Component
{
    public $notifications;
    public function mount()
    {
        $this->notifications = DatabaseNotification::whereNull('read_at')->latest()->get();
    }

    public function read(User $user)
    {
        $user->notifications()->first()->markAsRead();
        return redirect()->route('users.index', ['user' => $user]);
    }

    public function render()
    {
        return view('livewire.messages.index');
    }
}
