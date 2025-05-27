<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Users\Edit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
})->name('home');

// Users
Route::prefix('pengguna')->group(function () {
    Route::middleware('role:super admin', 'auth')->group(function () {
        Route::view('/', 'users')
            ->name('users.index');
        Route::get('/edit/{user:name}', Edit::class)
            ->name('user.edit');
        Route::view('/pesan', 'messages')
            ->name('messages.index');
    });
});


// Entry
Route::prefix('entry')->group(function () {
    Route::group(['middleware' => ['role:super admin|admin', 'auth']], function () {
        Route::view('/', 'entry')
            ->name('entry.index');
    });
    Route::group(['middleware' => ['role:super admin|admin', 'auth']], function () {
        Route::view('/tambah', 'create-entry')
            ->name('entry.create');
    });
});

// Cetak
Route::prefix('cetak')->group(function () {
    Route::group(['middleware' => ['role:super admin|admin', 'auth']], function () {
        Route::view('/rekonsiliasi', 'cetak-rekonsiliasi')
            ->name('cetak.rekonsiliasi');
        Route::view('/rekap', 'rekap')->name('rekap');
        Route::view('/laporan', 'perbandingan')->name('laporan');
    });
});

// Dashboard
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
