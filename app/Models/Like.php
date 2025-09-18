<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
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
     * @return MorphTo<Model, Like>
     */
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo<User, Like>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
}
