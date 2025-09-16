<?php

use App\Livewire\Backend\Settings\Account;
use App\Livewire\Backend\Settings\Appearance;
use App\Livewire\Backend\Settings\Password;
use Illuminate\Support\Facades\Route;


Route::prefix('backend')
    ->name('backend.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::view('dashboard', 'pages.backend.dashboard')
            ->middleware(['verified']) // dodaje se verified pored auth koji već važi za grupu
            ->name('dashboard');

        Route::redirect('settings', 'settings/account');
        Route::get('settings/account', Account::class)->name('settings.account');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
