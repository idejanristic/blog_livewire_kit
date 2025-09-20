<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('dashboard', Dashboard::class)
            ->middleware(['verified'])
            ->name('dashboard');
    });

require __DIR__ . '/settings/index.php';
