<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\AuthorRequest;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(function () {

        Route::get('dashboard', Dashboard::class)
            ->middleware(['verified'])
            ->name('dashboard');

        Route::get(uri: 'author/request', action: AuthorRequest::class)->name(name: 'author.request');
    });

require __DIR__ . '/settings/index.php';
require __DIR__ . '/feedbacks.php';
require __DIR__ . '/users/index.php';
