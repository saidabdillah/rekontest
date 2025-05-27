<?php

namespace App\Livewire\Users;

use App\Mail\SendEmailUserVerified;
use App\Models\User;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $user;
    public $data;

    public function render()
    {
        $users = User::whereNotIn('name', ['admin'])
            ->latest()
            ->paginate(1);

        return view('livewire.users.index', compact('users'));
    }


    public function cariUser()
    {
        $this->data = User::where('name', 'like', '%' . $this->user . '%')->latest()->get();
    }

    public function verifyUser($userId)
    {
        $user = User::findOrFail($userId);

        $user->email_verified_at = Carbon::now();
        $user->save();

        $this->dispatch('notif', message: 'User Berhasil Diverifikasi', type: 'success', title: 'Berhasil');
        Mail::to($user->email)->send(new SendEmailUserVerified($user));

        Flux::modals()->close();
        return redirect()->route('users.index');
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        DB::table('notifications')->select('notifiable_id')->where('notifiable_id', $user->id)->delete();

        $user->delete();

        $this->dispatch('notif', message: 'User Berhasil Dihapus', type: 'success', title: 'Berhasil');

        Flux::modals()->close();
        return redirect()->route('users.index');
    }
}
