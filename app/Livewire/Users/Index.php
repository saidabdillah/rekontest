<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    public $roles;
    public $user;
    public $permissions = [];


    public function mount()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::whereNotIn('name', ['super admin'])->get();
    }

    public function render()
    {
        return view('livewire.users.index', [
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
