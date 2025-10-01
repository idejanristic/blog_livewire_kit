<?php

use App\Livewire\Admin\Posts\Posts;
use App\Livewire\Admin\Posts\Trash;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/posts', action: Posts::class)->name(name: 'posts.index');

            Route::get(uri: '/posts/trashed', action: Trash::class)
                ->middleware(middleware: ['acl:post.restore'])
                ->name(name: 'posts.trashed');
        }
    );
