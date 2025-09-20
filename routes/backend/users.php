<?php

use App\Models\Acl\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::prefix('backend')
    ->name('backend.')
    ->middleware(['auth', 'acl:admin.access'])
    ->group(function () {

        Route::get(uri: '/users', action: function (): View {
            return View(view: 'pages.backend.users.index');
        })->name(name: 'users.index');

        Route::get(uri: '/users/{user}', action: function (User $user): View {
            return View(
                view: 'pages.backend.users.show',
                data: [
                    'user' => $user->load(relations: 'profile'),
                    'allRoles' => Role::all()->toArray()
                ]
            );
        })->name(name: 'users.show');

        Route::get(uri: '/users/{user}/permission', action: function (User $user): View {
            return View(
                view: 'pages.backend.users.permissions',
                data: [
                    'user' => $user->load(relations: 'profile'),
                    'permissions' => $user->permissions()
                ]
            );
        })->name(name: 'users.permission');

        Route::get(uri: '/users/{user}/posts', action: function (User $user): View {
            return View(
                view: 'pages.backend.users.posts',
                data: [
                    'user' => $user->load(relations: 'profile')
                ]
            );
        })->name(name: 'users.posts');

        Route::get(uri: '/users/{user}/comments', action: function (User $user): View {
            return View(
                view: 'pages.backend.users.comments',
                data: [
                    'user' => $user->load(relations: 'profile')
                ]
            );
        })->name(name: 'users.comments');
    });
