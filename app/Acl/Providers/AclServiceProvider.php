<?php

namespace App\Acl\Providers;

use App\Models\User;
use App\Acl\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole() || !Schema::hasTable('permissions')) {
            return;
        }

        $permissions = Permission::pluck(column: 'slug');

        foreach ($permissions as $permission) {
            Gate::define(
                ability: $permission,
                callback: function (User $user) use ($permission): mixed {
                    return $user->hasPermission(permission: $permission);
                }
            );
        }
    }
}
