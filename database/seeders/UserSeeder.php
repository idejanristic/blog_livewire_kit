<?php

namespace Database\Seeders;

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

        $subscriberRole->assignPermission([]);

        $authorRole->assignPermission([]);

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

        $adminRole->assignPermission([
            $adminAccessPermission->id,
            $manageUserPermission->id
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
