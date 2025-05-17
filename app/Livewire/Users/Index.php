<?php

namespace App\Livewire\Users;

use App\Mail\SendEmailUserVerified;
use App\Models\User;
use App\Notifications\SendEmailHasVerifUser;
use Carbon\Carbon;
use Flux\Flux;
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
        $users = User::nonAdmin()->when(
            $this->user,
            fn($query) =>
            $query->where('name', 'like', '%' . $this->user . '%')
        )
            ->latest()
            ->paginate(1);

        return view('livewire.users.index', compact('users'));
    }


    public function cariUser()
    {
        $this->data = User::where('name', 'like', '%' . $this->user . '%')->latest()->get();
    }

    public function updatingUser()
    {
        if (!empty($this->user)) $this->resetPage();
    }

    public function verifyUser($userId)
    {
        $user = User::findOrFail($userId);

        $user->email_verified_at = Carbon::now();
        $user->save();

        session()->flash('type', 'success');
        session()->flash('status', "{$user->name} berhasil diverifikasi.");
        Mail::to($user->email)->send(new SendEmailUserVerified($user));

        Flux::modals()->close();
        return redirect()->route('users.index');
    }
}
