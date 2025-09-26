<?php

namespace Database\Seeders;

use App\Acl\Enums\PermissionType;
use App\Models\User;
use App\Acl\Models\Role;
use App\Acl\Enums\RoleType;
use App\Acl\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        foreach (RoleType::cases() as $roleType) {
            $roleName = "{$roleType->value}Role";

            $$roleName = Role::create(attributes: [
                'name' => $roleType->label(),
                'slug' => $roleType->value,
                'description' => $roleType->description()
            ]);
        }

        foreach (PermissionType::cases() as $permissionType) {
            $permissonPostName = "{$permissionType->value}PostPermission";
            $$permissonPostName = Permission::create(attributes: [
                'name' => "{$permissionType->label()} post",
                'slug' => "{$permissionType->value}.post",
                'description' => "User can {$permissionType->Label()} a post"
            ]);
        }

        $subscriberRole->assignPermission([
            $viewPostPermission->id
        ]);

        $authorRole->assignPermission([
            $createPostPermission->id,
            $updatePostPermission->id,
            $deletePostPermission->id,
            $viewPostPermission->id
        ]);

        $adminAccessPermission = Permission::create(attributes: [
            'name' => 'Admin access',
            'slug' => 'admin.access',
            'description' => 'Access to admininistration part of application'
        ]);

        $manageUserPermission = Permission::create(attributes: [
            'name' => 'User menage',
            'slug' => 'user.menage',
            'description' => 'Permission to manage users to add roles and delete users'
        ]);

        $trashPostPermission = Permission::create(attributes: [
            'name' => 'Post trash',
            'slug' => 'post.trash',
            'description' => 'Can access to trash of posts'
        ]);

        $publishPostPermission = Permission::create(attributes: [
            'name' => 'Post publish',
            'slug' => 'post.publish',
            'description' => 'User can publishing a post'
        ]);

        $restorePostPermission = Permission::create(attributes: [
            'name' => 'Post restore',
            'slug' => 'post.restore',
            'description' => 'User can restore a post'
        ]);

        $adminRole->assignPermission([
            $adminAccessPermission->id,
            $manageUserPermission->id,
            $trashPostPermission->id,
            $publishPostPermission->id,
            $restorePostPermission->id,
            $createPostPermission->id,
            $updatePostPermission->id,
            $deletePostPermission->id,
            $viewPostPermission->id,
        ]);

        $admin = User::factory()->create(
            attributes: [
                'name' => env(key: 'ADMIN_NAME', default: 'Admin'),
                'email' => env(key: 'ADMIN_EMAIL', default: 'dejanr77@yahoo.com'),
                'password' => bcrypt(env(key: 'ADMIN_PASSWORD', default: '12345678')),
                'email_verified_at' => now()
            ]
        );

        if (! $admin->save()) {
            dump('Unable to create admin ' . $admin->name, (array) $admin->errors());
        } else {
            $admin->assignRole(role_id: $adminRole->id);
            dump('Created admin "' . $admin->name . '" <' . $admin->email . '>');
        }

        User::factory()
            ->count(count: 29)
            ->create()
            ->each(
                callback: function (User $user) use ($subscriberRole): void {
                    $user->assignRole(role_id: $subscriberRole->id);
                }
            );
    }
}
