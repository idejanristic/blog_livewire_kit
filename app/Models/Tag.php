<?php

namespace App\Models;

use App\Enums\TagSource;
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
        'source' => TagSource::class
    ];

    /**
     * @return BelongsToMany<Post, Tag, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(related: Post::class)
            ->withTimestamps();
    }
}
