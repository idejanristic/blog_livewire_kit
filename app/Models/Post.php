<?php

namespace App\Models;

use App\Enums\PostSource;
use App\Casts\DatetimeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'user_id'
    ];

    protected $casts = [
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
        $query->where(column: 'published_at', operator: '>=', value: now());
    }

    /**
     * @return BelongsToMany<Tag, Post, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(related: Tag::class)
            ->withTimestamps();
    }
}
