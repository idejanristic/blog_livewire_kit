<?php

namespace App\Models;

use App\Casts\DatetimeCast;
use App\Enums\TagSource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'source'
    ];

    protected $casts = [
        'source' => TagSource::class,
        'created_at' => DatetimeCast::class,
        'updated_at' => DatetimeCast::class,
    ];

    /**
     * @return BelongsToMany<Post, Tag, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(related: Post::class)
            ->withTimestamps();
    }

    /**
     * @return int
     */
    public function getPostsCountAttribute(): int
    {
        if (array_key_exists('posts_count', $this->attributes)) {
            return (int) $this->attributes['posts_count'];
        }

        return $this->posts()->count();
    }

    /**
     * @return void
     */
    protected static function booted()
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
