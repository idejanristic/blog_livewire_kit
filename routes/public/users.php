<?php

use App\Livewire\Public\UserCentar\Activities;
use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\AuthorRequest;
use App\Livewire\Public\UserCentar\Posts;
use App\Livewire\Public\UserCentar\Comments;
use App\Livewire\Public\UserCentar\EditPost;
use App\Livewire\Public\UserCentar\CreatePost;

Route::middleware(['auth'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/user/centar', action: Posts::class)
                ->middleware(middleware: 'acl:view.post')
                ->name(name: 'user.center.index');

            Route::get(uri: '/user/centar/comments', action: Comments::class)
                ->middleware(middleware: 'acl:view.comment')
                ->name(name: 'user.center.comments');

            Route::get(uri: '/user/centar/activity', action: Activities::class)
                ->name(name: 'user.center.activity');

            Route::get(uri: '/user/posts/create', action: CreatePost::class)
                ->middleware(middleware: 'acl:create.post')
                ->name(name: 'user.posts.create');

            Route::get(uri: '/user/posts/{id}/edit', action: EditPost::class)
                ->middleware(middleware: 'acl:update.post')
                ->name(name: 'user.posts.edit');

            Route::get(uri: '/user/centar/author/request', action: AuthorRequest::class)
                ->name(name: 'user.center.author.request');
        }
    );
