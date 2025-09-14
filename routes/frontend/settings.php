<?php

use App\Livewire\Frontend\Settings\Appearance;
use App\Livewire\Frontend\Settings\Password;
use App\Livewire\Frontend\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->group(callback: function (): void {
        Route::redirect(uri: 'settings', destination: 'settings/profile');
        Route::get(uri: 'settings/profile', action: Profile::class)->name('settings.profile');
        Route::get(uri: 'settings/password', action: Password::class)->name('settings.password');
        Route::get(uri: 'settings/appearance', action: Appearance::class)->name('settings.appearance');
    });
