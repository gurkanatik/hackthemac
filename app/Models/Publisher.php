<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMeta;
use App\Traits\HasCoverImage;


/**
 * @property string|null $cover_image
 */
class Publisher extends Model
{
    use HasMeta, HasCoverImage;

    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'content',
        'publisher_type',
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
