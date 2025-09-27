<?php

namespace App\Models;

use App\Enums\PostSource;
use App\Casts\DatetimeCast;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
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
        'status_comment' => 'boolean',
        'source' => PostSource::class,
        'created_at' => DatetimeCast::class,
        'updated_at' => DatetimeCast::class,
        'published_at' => DatetimeCast::class
    ];

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
     * Scope a query to only include published posts
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where(
            column: 'published_at',
            operator: '>=',
            value: Carbon::now()->format('Y-m-d')
        );
    }

    /**
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
