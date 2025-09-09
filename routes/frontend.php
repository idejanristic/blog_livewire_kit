<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.frontend.home');
})->name('home');
