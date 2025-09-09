<?php

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/',
    action: function (): View {
        return view('pages.frontend.home');
    }
)->name(name: 'home');

Route::get(
    uri: '/about',
    action: function (): View {
        return view('pages.frontend.about');
    }
)->name(name: 'about');

Route::get(
    uri: '/contact',
    action: function (): View {
        return view('pages.frontend.contact');
    }
)->name(name: 'contact');

Route::get(
    uri: '/posts',
    action: function (): View {
        return view('pages.frontend.posts.index');
    }
)->name(name: 'posts.index');

Route::get(
    uri: '/posts/{post}',
    action: function (Post $post): View {
        return view('pages.frontend.posts.show', [
            'post' => $post
        ]);
    }
)->name(name: 'posts.show');
