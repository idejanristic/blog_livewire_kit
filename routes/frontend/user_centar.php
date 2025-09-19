<?php

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->group(callback: function () {
        Route::get(uri: '/user/centar', action: function (): View {
            return View(view: 'pages.frontend.user-centar.show');
        })
            ->middleware(middleware: 'acl:view.post')
            ->name(name: 'user.center.show');

        Route::get(uri: '/user/centar/activity', action: function (): View {
            return View(view: 'pages.frontend.user-centar.activity');
        })->name(name: 'user.center.activity');

        Route::get(uri: '/user/posts/create', action: function (): View {
            return View(view: 'pages.frontend.user-centar.create');
        })
            ->middleware(middleware: 'acl:create.post')
            ->name(name: 'user.posts.create');

        Route::get(uri: '/user/posts/{post}/edit', action: function (Post $post): View {
            return View(view: 'pages.frontend.user-centar.edit', data: [
                'post' => $post
            ]);
        })
            ->middleware(middleware: 'acl:update.post')
            ->name(name: 'user.posts.edit');
    });
