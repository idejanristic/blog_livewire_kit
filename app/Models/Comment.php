<?php

namespace App\Models;

use App\Casts\DatetimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'post_id',
        'user_id'
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
            'updated_at' => DatetimeCast::class,
        ];
    }

    /**
     * @return BelongsTo<User, Comment>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    /**
     * @return BelongsTo<Post, Comment>
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(related: Post::class);
    }

    /**
     * @return MorphMany<Like, Comment>
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(related: Like::class, name: 'likeable');
    }

    /**
     * @return MorphMany<Dislike, Comment>
     */
    public function dislikes(): MorphMany
    {
        return $this->morphMany(related: Dislike::class, name: 'dislikeable');
    }
}
