<?php

use App\Dtos\Activities\ActivityDto;
use App\Models\Post;
use App\Models\User;
use App\Enums\UserAcivityType;
use Illuminate\Contracts\View\View;
use App\Services\UserActivityService;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/posts', action: function (): View {
    return view(view: 'pages.frontend.posts.index');
})->name(name: 'posts.index');

Route::get(uri: '/posts/user/{user}', action: function (User $user): View {
    return view(
        view: 'pages.frontend.posts.user',
        data: [
            'user' => $user->load('profile')
        ]
    );
})->name(name: 'posts.user');

Route::get(uri: '/posts/{post}', action: function (Post $post): View {
    UserActivityService::log(
        dto: ActivityDto::apply(
            data: [
                'model' => $post,
                'type' =>  UserAcivityType::Viewed,
                'content' => 'Post "' . $post->title . '" was viewed',
                'ip' => request()->ip()
            ]
        )
    );

    return view(
        view: 'pages.frontend.posts.show',
        data: [
            'post' =>  $post->load('user.profile', 'tags')
        ]
    );
})->name(name: 'posts.show');
