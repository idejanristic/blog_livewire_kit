<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dislike extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * @return MorphTo<Model, Dislike>
     */
    public function dislikeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo<User, Dislike>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
}
