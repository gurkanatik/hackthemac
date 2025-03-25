<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'order_num',
        'description',
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
