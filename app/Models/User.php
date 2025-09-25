<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Acl\Enums\RoleType;
use App\Acl\Enums\UserSource;
use App\Acl\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'source'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $appends = ['is_online'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'source' => UserSource::class
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get all roles for the user
     *
     * @return BelongsToMany<Role, User, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(related: Role::class)->withTimestamps();
    }

    /**
     * Checks does the user have role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        if (is_null(value: $role)) {
            return false;
        }

        return $this->roles->contains('slug', $role);
    }

    /**
     * @param mixed $permission
     * @return bool
     */
    public function userCan(?string $permission = null): bool
    {
        return !is_null(value: $permission)
            && $this->hasPermission(permission: $permission);
    }

    /**
     * Checks does the user have permission
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        if (is_null(value: $permission)) {
            return false;
        }

        return $this->roles->flatMap->permissions
            ->pluck('slug')->unique()->contains($permission);
    }

    /**
     * Assigns a new role
     *
     * @param mixed $role_id
     * @return array{attached: array, detached: array, updated: array}
     */
    public function assignRole($role_id): array
    {
        return $this->roles()->sync(ids: [$role_id]);
    }

    /**
     * Checks is the user admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->roles->pluck('slug')
            ->contains(key: RoleType::ADMIN->value);
    }

    /**
     * @return HasMany<Session, User>
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(related: Session::class, foreignKey: 'user_id');
    }

    /**
     * @return bool
     */
    public function getIsOnlineAttribute(): bool
    {
        return $this->sessions->count() > 0;
    }
}
