<?php

namespace App\Policies;

use App\Acl\Enums\RoleType;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return $user->own(releted: $post);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if (
            $post->published_at !== null
            && Carbon::today()->greaterThanOrEqualTo(date: $post->published_at)
        ) {
            return false;
        }

        if (
            $user->own(releted: $post)
            && $user->hasPermission(permission: 'update.post')
        ) {
            return true;
        }

        return false;
    }


    public function publish(User $user, Post $post): bool
    {
        if (
            $post->published_at !== null
            && Carbon::today()->greaterThanOrEqualTo(date: $post->published_at)
        ) {
            return false;
        }

        return $user->hasPermission(permission: 'post.publish');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->hasRole(role: RoleType::ADMIN->value)) {
            return true;
        }

        return $user->own(releted: $post)
            && $user->hasPermission(permission: 'delete.post');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->own(releted: $post);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->own(releted: $post)
            && $user->hasPermission(permission: 'delete.post');
    }
}
