<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Spatie\Permission\Models\Role;

class UsersView extends Component
{
    use WithPagination;
    public $roles;


    public function mount()
    {
        $this->roles = Role::whereNotIn('name', ['super admin'])->get();
    }

    // public function updating()
    // {
    //     $this->roles = Role::whereNotIn('name', ['super admin'])->get();
    // }

    public function render()
    {
        return view('livewire.users.users-view', [
            'users' => User::withoutRole('super admin')->with('roles')->get(),
        ]);
    }

    public function verifyUser($user)
    {
        $user = User::find($user);
        $user->email_verified_at = Carbon::now();
        $user->save();
        session()->flash('status', "{$user->name} berhasil diverifikasi.");
    }
}
