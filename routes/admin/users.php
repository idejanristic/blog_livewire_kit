<?php

use App\Livewire\Admin\Users\All;
use App\Livewire\Admin\Users\Show;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\Roles;
use App\Livewire\Actions\RestoreUser;
use App\Livewire\Admin\Users\Treshed;
use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\AddAuthorRole;
use App\Livewire\Admin\Users\Roles\Edit;
use App\Livewire\Admin\Users\Roles\Create;
use App\Livewire\Actions\RemoveAuthorRequest;
use App\Livewire\Admin\Users\Permissions\Show as PermissionsShow;

Route::prefix('admin/users')
    ->name('admin.users.')
    ->middleware(['auth', 'acl:admin.access', 'acl:user.menage'])
    ->group(
        callback: function (): void {
            Route::get(uri: '/', action: Index::class)->name(name: 'index');
            Route::get(uri: 'all', action: All::class)->name(name: 'all');
            Route::get(uri: 'treshed', action: Treshed::class)->name(name: 'treshed');
            Route::get(uri: 'restore/{id}', action: RestoreUser::class)->name(name: 'restore');

            Route::get(uri: '/roles', action: Roles::class)->name(name: 'roles');
            Route::get(uri: '/roles/create', action: Create::class)->name(name: 'roles.create');
            Route::get(uri: '/roles/{id}/edit', action: Edit::class)->name(name: 'roles.edit');

            Route::get(uri: '/permissions/{id}', action: PermissionsShow::class)->name(name: 'permissions.show');

            Route::get(uri: '/{id}', action: Show::class)->name(name: 'show');
            Route::get(uri: '/add/author/role/{id}', action: AddAuthorRole::class)->name(name: 'add.author.role');
            Route::get(uri: '/remove/author/request/{id}', action: RemoveAuthorRequest::class)->name(name: 'remove.author.request');
        }
    );
