<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
})->name('home');

// Users
Route::prefix('users')->group(function () {
    Route::middleware('role:super admin')->group(function () {
        Route::view('/', 'users')
            ->name('users.index');
        Route::view('/messages', 'messages')
            ->name('messages.index');
    });
});

// Entry
Route::prefix('entry')->group(function () {
    Route::view('/', 'entry')
        ->name('entry.index')
        ->middleware('role:super admin|admin');
    Route::view('/create', 'create-entry')
        ->name('entry.create')
        ->middleware('role:super admin');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

require __DIR__ . '/auth.php';
