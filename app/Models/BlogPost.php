<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTags;
use App\Traits\HasMeta;

class BlogPost extends Model
{
    use HasTags, HasMeta;
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('published_at')->orderByDesc('id');
        });
    }
}
