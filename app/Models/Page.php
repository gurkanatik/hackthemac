<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_active',
    ];

    public function meta()
    {
        return $this->morphOne(MetaRelation::class, 'relation');
    }

    protected static function booted()
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }
}
