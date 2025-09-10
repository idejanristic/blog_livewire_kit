<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/',
    action: function (): View {
        return view(view: 'pages.frontend.home');
    }
)->name(name: 'home');

Route::get(
    uri: '/about',
    action: function (): View {
        return view(view: 'pages.frontend.about');
    }
)->name(name: 'about');

Route::get(
    uri: '/contact',
    action: function (): View {
        return view(view: 'pages.frontend.contact');
    }
)->name(name: 'contact');

Route::get(
    uri: '/posts',
    action: function (): View {
        return view(view: 'pages.frontend.posts.index');
    }
)->name(name: 'posts.index');

Route::get(
    uri: '/posts/user/{user}',
    action: function (User $user): View {
        return view(
            view: 'pages.frontend.posts.user',
            data: [
                'user' => $user
            ]
        );
    }
)->name(name: 'posts.user');

Route::get(
    uri: '/posts/{post}',
    action: function (Post $post): View {
        return view(
            view: 'pages.frontend.posts.show',
            data: [
                'post' => $post
            ]
        );
    }
)->name(name: 'posts.show');
