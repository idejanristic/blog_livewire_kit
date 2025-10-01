<?php

use App\Livewire\Public\Posts\Show;
use App\Livewire\Public\Posts\Posts;
use App\Livewire\Actions\PublishPost;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Posts\User\Posts as UserPosts;

Route::get(uri: '/posts', action: Posts::class)->name(name: 'posts.index');
Route::get(uri: '/posts/{id}', action: Show::class)->name(name: 'posts.show');
Route::get(uri: '/posts/user/{id}', action: UserPosts::class)->name(name: 'posts.user');
Route::get(uri: '/posts/{id}/publish', action: PublishPost::class)->name(name: 'posts.publish');

Route::get(uri: '/posts/{id}/trash', action: Show::class)
    ->middleware(['auth', 'acl:post.trash'])
    ->name(name: 'posts.trash');
