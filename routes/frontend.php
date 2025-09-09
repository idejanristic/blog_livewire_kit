<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View {
    return view('pages.frontend.home');
})->name(name: 'home');

Route::get('/about', function (): View {
    return view('pages.frontend.about');
})->name(name: 'about');

Route::get('/contact', action: function (): View {
    return view('pages.frontend.contact');
})->name(name: 'contact');

Route::get('/posts', function (): View {
    return view('pages.frontend.posts.index');
})->name(name: 'posts.index');
