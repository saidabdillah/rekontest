<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    public $user;
    public $users;
    public $roles;

    public function mount()
    {
        $this->users = User::withoutRole('super admin')->with('roles')->latest()->get();
        $this->roles = Role::whereNotIn('name', ['super admin'])->get();
    }

    public function render()
    {
        return view('livewire.users.index');
    }

    public function verifyUser($user)
    {
        $user = User::find($user);
        $user->email_verified_at = Carbon::now();
        $user->save();
        session()->flash('status', "{$user->name} berhasil diverifikasi.");
        Flux::modals()->close();
    }
}
