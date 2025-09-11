<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: function (): View {
    return view(view: 'pages.frontend.home');
})->name(name: 'home');

Route::get(uri: '/about', action: function (): View {
    return view(view: 'pages.frontend.about');
})->name(name: 'about');

Route::get(uri: '/contact', action: function (): View {
    return view(view: 'pages.frontend.contact');
})->name(name: 'contact');
