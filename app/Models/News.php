<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTags;
use App\Traits\HasMeta;
use App\Traits\HasCoverImage;

/**
 * @property string|null $cover_image
 */
class News extends Model
{
    use HasTags, HasMeta, HasCoverImage;

    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'content',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }
}
