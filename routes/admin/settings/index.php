<?php

use App\Livewire\Admin\Settings\Appearance;
use App\Livewire\Admin\Settings\Password;
use App\Livewire\Admin\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/settings')
    ->name('admin.settings.')
    ->middleware(['auth'])
    ->group(function () {
        Route::redirect('/', 'settings/profile');
        Route::get('profile', Profile::class)->name('profile');
        Route::get('password', Password::class)->name('password');
        Route::get('appearance', Appearance::class)->name('appearance');
    });
