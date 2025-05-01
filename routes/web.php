<?php

use App\Livewire\Entry\Create as EntryCreate;
use App\Livewire\Entry\View as EntryView;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Users\UsersView;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
})->name('home');

Route::prefix('entry')->group(function () {
    Route::get('/create', EntryCreate::class)->name('entry.create')->middleware('auth', 'role:super admin');
    Route::get('/view', EntryView::class)->name('entry.view')->middleware('auth', 'role:super admin|admin');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['role:super admin', 'auth'])->group(function () {
    Route::view('/users', 'users')
        // ->middleware(['auth', 'verified'])
        ->name('users.view');
    Route::view('/users/edit', 'editUser')
        ->name('user.edit');
    Route::view('/messages/user', 'messages')
        ->name('messages.index');
});

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

require __DIR__ . '/auth.php';
