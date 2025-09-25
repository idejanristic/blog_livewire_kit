<?php

namespace App\Acl\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * The users that belong to the role
     *
     * @return BelongsToMany<User, Role, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class)->withTimestamps();
    }

    /**
     * The permissions that belong to role.
     *
     * @return BelongsToMany<Permission, Role, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(related: Permission::class)->withTimestamps();
    }

    /**
     * Sync up the list of permission for this role in the database
     *
     * @param mixed $permission_id
     * @return array{attached: array, detached: array, updated: array}
     */
    public function assignPermission($permission_id): array
    {
        return $this->permissions()->sync(ids: $permission_id);
    }
}
