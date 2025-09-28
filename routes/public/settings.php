<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Settings\Account;
use App\Livewire\Public\Settings\UserProfile;
use App\Livewire\Public\Settings\Password;
use App\Livewire\Public\Settings\Appearance;

Route::prefix('settings')
    ->name('settings.')
    ->middleware(['auth'])
    ->group(callback: function (): void {
        Route::redirect('/', 'settings/account');
        Route::get('account', Account::class)->name('account');
        Route::get('profile', UserProfile::class)->name('profile');
        Route::get('password', Password::class)->name('password');
        Route::get('appearance', Appearance::class)->name('appearance');
    });
