<?php

namespace App\Models;

use App\Traits\HasTags;
use App\Traits\HasMeta;
use App\Traits\HasCoverImage;
use App\Traits\HasPlatforms;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasTags, HasMeta, HasCoverImage, HasPlatforms;

    protected $fillable = [
        'publisher_id',
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'content',
        'mac_support',
        'price',
        'is_active',
        'published_at',
        'release_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'release_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
