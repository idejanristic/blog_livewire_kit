<?php

use App\Livewire\Public\Posts\Show;
use App\Livewire\Public\Posts\Posts;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Posts\User\Posts as UserPosts;

Route::get(uri: '/posts', action: Posts::class)->name(name: 'posts.index');
Route::get(uri: '/posts/{id}', action: Show::class)->name(name: 'posts.show');
Route::get(uri: '/posts/user/{id}', action: UserPosts::class)->name(name: 'posts.user');
