<?php

use App\Livewire\Public\Posts\Posts;
use App\Livewire\Public\Posts\Show;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/posts', action: Posts::class)->name(name: 'posts.index');
Route::get(uri: '/posts/{id}', action: Show::class)->name(name: 'posts.show');
