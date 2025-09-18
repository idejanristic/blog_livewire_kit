<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * The roles that belong to permission
     *
     * @return BelongsToMany<Role, Permission, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(related: Role::class);
    }
}
