<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Tags\Tags;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/tags', action: Tags::class)
                ->middleware(middleware: ['acl:view.tag'])
                ->name(name: 'tags.index');
        }
    );
