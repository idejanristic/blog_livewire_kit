<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Acl\Models\Role;
use App\Acl\Enums\RoleType;
use App\Casts\DatetimeCast;
use Illuminate\Support\Str;
use App\Acl\Enums\UserSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'author_request',
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

    protected $appends = ['is_online', 'has_profile', 'profile_name', 'profile_title'];

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
            'source' => UserSource::class,
            'created_at' => DatetimeCast::class,
            'updated_at' => DatetimeCast::class,
            'author_request' => 'boolean'
        ];
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

    /**
     * Get the posts for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(related: Post::class);
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
     * Get the feedbacks for user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(related: Feedback::class);
    }

    /**
     *  @return HasMany<Comment, Post>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class);
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
}
