<?php

namespace App\Models;

use App\Enums\PostSource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'published_at',
        'source',
        'status_comment',
        'user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'source' => PostSource::class,
        'status_comment' => 'boolean'
    ];

    /**
     * @return int
     */
    public function getCommentsCountAttribute(): int
    {
        if (array_key_exists('comments_count', $this->attributes)) {
            return (int) $this->attributes['comments_count'];
        }

        return $this->comments()->count();
    }

    /**
     * A post is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    /**
     *
     * @return BelongsToMany<Tag, Post, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(related: Tag::class)
            ->withTimestamps();
    }

    /**
     *  @return HasMany<Comment, Post>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class)
            ->orderBy(
                column: 'created_at',
                direction: 'desc'
            );
    }

    /**
     * @return MorphMany<Like, Post>
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(related: Like::class, name: 'likeable');
    }

    /**
     * @return MorphMany<DisLike, Post>
     */
    public function dislikes(): MorphMany
    {
        return $this->morphMany(related: Dislike::class, name: 'dislikeable');
    }

    /**
     * Scope a query to only include published posts
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include acitve posts
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where(column: 'active', operator: true);
    }

    /**
     * Scope a query to only include inacitve posts
     */
    #[Scope]
    protected function inactive(Builder $query): void
    {
        $query->where(column: 'active', operator: false);
    }

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::saved(
            callback: function ($post): void {
                Cache::forget(key: 'tags_with_posts_count');
            }
        );

        static::deleted(
            callback: function ($post): void {
                Cache::forget(key: 'tags_with_posts_count');
            }
        );
    }
}
