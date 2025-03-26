<?php

namespace App\Models;

use App\Traits\HasMeta;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasMeta;
    protected $fillable = [
        'title',
        'slug',
        'order_num',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }
}
