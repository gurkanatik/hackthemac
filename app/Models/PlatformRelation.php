<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformRelation extends Model
{
    protected $fillable = [
        'platform_id',
        'relation_id',
        'relation_type',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
