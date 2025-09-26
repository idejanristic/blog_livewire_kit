<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\AuthorRequest;
use App\Livewire\Public\UserCentar\Posts;

Route::middleware(['auth'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/user/centar', action: Posts::class)
                ->name(name: 'user.center.index');

            Route::get(uri: '/user/centar/author/request', action: AuthorRequest::class)
                ->name(name: 'user.center.author.request');
        }
    );
