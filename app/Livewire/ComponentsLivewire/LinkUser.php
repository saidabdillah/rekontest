<?php

namespace App\Livewire\ComponentsLivewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Notifications\DatabaseNotification;

class LinkUser extends Component
{
    public $new_users;
    public function mount()
    {
        $this->new_users = DatabaseNotification::whereNull('read_at')->count();
    }

    public function render()
    {
        return view('livewire.components-livewire.link-user');
    }
}
