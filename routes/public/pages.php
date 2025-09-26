<?php

use App\Livewire\Public\Home;
use App\Livewire\Public\About;
use App\Livewire\Public\Contact;
use Illuminate\Support\Facades\Route;


Route::get(uri: '/', action: Home::class)->name(name: 'home');
Route::get(uri: '/about', action: About::class)->name(name: 'about');
Route::get(uri: '/contact', action: Contact::class)->name(name: 'contact');
