<?php

use App\Livewire\Admin\Users\All;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\Show;
use App\Livewire\Admin\Users\Treshed;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/users')
    ->name('admin.users.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(function () {
        Route::get(uri: '/', action: Index::class)->name(name: 'index');
        Route::get(uri: 'all', action: All::class)->name(name: 'all');
        Route::get(uri: 'treshed', action: Treshed::class)->name(name: 'treshed');

        Route::get(uri: '/{id}', action: Show::class)->name(name: 'show');
    });
