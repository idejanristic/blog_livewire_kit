<?php

use App\Livewire\Public\Posts\Posts;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/post', action: Posts::class)->name(name: 'posts.index');
