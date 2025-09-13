<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/posts', action: function (): View {
    return view(view: 'pages.frontend.posts.index');
})->name(name: 'posts.index');

Route::middleware(['auth'])
    ->group(function () {
        Route::get(uri: '/posts/create', action: function (): View {
            return View(view: 'pages.frontend.posts.create');
        })->name(name: 'posts.create');

        Route::get(uri: '/posts/{post}/edit', action: function (Post $post): View {
            return View(view: 'pages.frontend.posts.edit', data: [
                'post' => $post
            ]);
        })->name(name: 'posts.edit');
    });


Route::get(uri: '/posts/user/{user}', action: function (User $user): View {
    return view(
        view: 'pages.frontend.posts.user',
        data: [
            'user' => $user
        ]
    );
})->name(name: 'posts.user');

Route::get(uri: '/posts/{post}', action: function (Post $post): View {
    return view(
        view: 'pages.frontend.posts.show',
        data: [
            'post' => $post
        ]
    );
})->name(name: 'posts.show');
