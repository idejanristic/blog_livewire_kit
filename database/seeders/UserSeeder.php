<?php

namespace Database\Seeders;

use App\Enums\PermissionType;
use App\Enums\RoleType;
use App\Models\Acl\Permission;
use App\Models\Acl\Role;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (RoleType::cases() as $roleType) {
            $roleName = "{$roleType->value}Role";

            $$roleName = Role::create(attributes: [
                'name' => $roleType->value
            ]);
        }

        foreach (PermissionType::cases() as $permissionType) {
            $permissonPostName = "{$permissionType->value}PostPermission";
            $$permissonPostName = Permission::create(attributes: [
                'name' => "{$permissionType->value}.post"
            ]);

            $permissonTagName = "{$permissionType->value}TagPermission";
            $$permissonTagName = Permission::create(attributes: [
                'name' => "{$permissionType->value}.tag"
            ]);

            $permissonCommentName = "{$permissionType->value}CommentPermission";
            $$permissonCommentName = Permission::create(attributes: [
                'name' => "{$permissionType->value}.comment"
            ]);
        }

        $subscriberRole->assignPermission([
            $createCommentPermission->id,
            $deleteCommentPermission->id
        ]);

        $authorRole->assignPermission([
            $createCommentPermission->id,
            $deleteCommentPermission->id,
            $createPostPermission->id,
            $updatePostPermission->id,
            $deletePostPermission->id,
            $viewPostPermission->id
        ]);

        $adminAccessPermission = Permission::create(attributes: [
            'name' => 'admin.access'
        ]);

        $trashArticlePermission = Permission::create(attributes: [
            'name' => 'post.trash'
        ]);

        $trashCommentPermission = Permission::create(attributes: [
            'name' => 'comment.trash',
        ]);

        $publishPostPermission = Permission::create(attributes: [
            'name' => 'post.publish',
        ]);

        $restorePostPermission = Permission::create(attributes: [
            'name' => 'post.restore',
        ]);

        $restoreCommentPermission = Permission::create(attributes: [
            'name' => 'comment.restore',
        ]);


        $adminRole->assignPermission([
            $createCommentPermission->id,
            $deleteCommentPermission->id,
            $createPostPermission->id,
            $updatePostPermission->id,
            $deletePostPermission->id,
            $viewPostPermission->id,
            $createTagPermission->id,
            $updateTagPermission->id,
            $deleteTagPermission->id,
            $viewTagPermission->id,
            $adminAccessPermission->id,
            $trashArticlePermission->id,
            $trashCommentPermission->id,
            $publishPostPermission->id,
            $restorePostPermission->id,
            $restoreCommentPermission->id
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
                    if (fake()->boolean(chanceOfGettingTrue: 70)) {
                        Profile::factory()->forUser($user)->create();
                    }

                    $user->assignRole(role_id: $subscriberRole->id);
                }
            );
    }
}
