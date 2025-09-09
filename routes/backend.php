<?php

use App\Livewire\Backend\Settings\Appearance;
use App\Livewire\Backend\Settings\Password;
use App\Livewire\Backend\Settings\Profile;
use Illuminate\Support\Facades\Route;


Route::prefix('backend')
    ->name('backend.')
    ->middleware(['auth'])
    ->group(function () {

        Route::view('dashboard', 'pages.backend.dashboard')
            ->middleware(['verified']) // dodaje se verified pored auth koji već važi za grupu
            ->name('dashboard');

        Route::redirect('settings', 'settings/profile');
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
