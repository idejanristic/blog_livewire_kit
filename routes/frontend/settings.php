<?php

use App\Livewire\Frontend\Settings\Appearance;
use App\Livewire\Frontend\Settings\Password;
use App\Livewire\Frontend\Settings\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->name('settings.')
    ->middleware('auth')
    ->group(function () {
        Route::redirect('/', 'settings/profile');

        Route::get('profile', Profile::class)->name('profile');
        Route::get('password', Password::class)->name('password');
        Route::get('appearance', Appearance::class)->name('appearance');
    });
