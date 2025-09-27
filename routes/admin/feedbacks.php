<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Feedbacks\Show;
use App\Livewire\Admin\Feedbacks\Feedbacks;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(
        callback: function (): void {
            Route::get(uri: 'feedbacks', action: Feedbacks::class)->name(name: 'feedbacks.index');
            Route::get(uri: 'feedbacks/{id}', action: Show::class)->name(name: 'feedbacks.show');
        }
    );
