<?php

namespace App\Acl\Models;

use App\Casts\DatetimeCast;
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => DatetimeCast::class,
            'updated_at' => DatetimeCast::class
        ];
    }

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
