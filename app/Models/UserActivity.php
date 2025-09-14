<?php

namespace App\Models;

use App\Enums\UserAcivityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'user_id',
        'type',
        'model',
        'model_id',
        'content'
    ];

    protected $casts = [
        'type' => UserAcivityType::class
    ];

    /**
     * This activity is owned by a user
     *
     * @return BelongsTo<User, UserActivity>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
}
