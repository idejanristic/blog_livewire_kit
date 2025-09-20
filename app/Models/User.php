<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserSource;
use App\Models\Acl\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
        'remember_token',
    ];

    protected $appends = ['has_profile', 'profile_name', 'profile_title'];

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
     * Accessor for "has_profile".
     */
    protected function hasProfile(): Attribute
    {
        return Attribute::get(
            get: function (): bool {
                if ($this->relationLoaded('profile')) {
                    return !is_null($this->getRelation(relation: 'profile'));
                }

                return $this->profile()->exists();
            }
        );
    }

    /**
     * Accessor for "profile_name".
     */
    protected function profileName(): Attribute
    {
        return Attribute::get(
            get: function (): mixed {
                if ($this->relationLoaded(key: 'profile')) {
                    return $this->profile ? $this->profile->full_name : $this->name;
                }

                // fallback ako lazy loading nije dozvoljen
                return $this->name;
            }
        );
    }

    /**
     * Accessor for "profile_name".
     */
    protected function profileTitle(): Attribute
    {
        return Attribute::get(
            get: function (): mixed {
                if ($this->relationLoaded(key: 'profile')) {
                    return $this->profile ? $this->profile->title : '';
                }

                // fallback ako lazy loading nije dozvoljen
                return "";
            }
        );
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $name = $this->profile_name;

        return Str::of($name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the posts for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(related: 'App\Models\Post');
    }

    /**
     * Get the feedbacks for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(related: 'App\Models\Feedback');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $releted
     * @return bool
     */
    public function own(Model $releted): bool
    {
        return $this->id === $releted->user_id;
    }

    /**
     * @return HasMany<Like, User>
     */
    public function likes(): HasMany
    {
        return $this->hasMany(related: Like::class);
    }

    /**
     * @return HasMany<Dislike, User>
     */
    public function dislikes(): HasMany
    {
        return $this->hasMany(related: Dislike::class);
    }

    /**
     * @return HasOne<Profile, User>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(related: Profile::class);
    }

    /**
     * @return \Illuminate\Support\Collection<int, mixed>
     */
    public function permissions(): Collection
    {
        return $this->roles()
            ->with(relations: 'permissions')
            ->get()
            ->pluck(value: 'permissions')
            ->flatten()
            ->unique('id');
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

        return $this->roles()
            ->where(column: 'slug', operator: $role)
            ->exists();
    }

    /**
     * @param mixed $permission
     * @return bool
     */
    public function userCan(?string $permission = null): bool
    {
        return !is_null(value: $permission) && $this->hasPermission(permission: $permission);
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

        if (is_string(value: $permission)) {
            return $this->roles()
                ->whereRelation(relation: 'permissions', column: 'slug', operator: $permission)
                ->exists();
        }

        return false;
    }

    /**
     * Assigns a new role.
     *
     * @param $role_id
     * @return array
     */
    public function assignRole($role_id): array
    {
        return $this->roles()->sync(ids: [$role_id]);
    }

    /**
     * Checks is the user admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(role: 'admin');
    }
}
