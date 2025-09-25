<?php

namespace App\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
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
     * The roles that belong to permission
     *
     * @return BelongsToMany<Role, Permission, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(related: Role::class)->withTimestamps();
    }
}
