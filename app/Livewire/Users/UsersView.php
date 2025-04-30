<?php

namespace App\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UsersView extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.users.users-view', [
            'users' => User::paginate(2),
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
