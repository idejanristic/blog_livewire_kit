<?php

use App\Livewire\Admin\Comments\Comments;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/comments', action: Comments::class)->name(name: 'comments.index');
        }
    );
