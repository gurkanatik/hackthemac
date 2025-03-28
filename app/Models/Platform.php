<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMeta;

class Platform extends Model
{
    use HasMeta;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }
}
