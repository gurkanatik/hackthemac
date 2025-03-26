<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlatformRelation extends Model
{
    protected $fillable = [
        'platform_id',
        'relation_id',
        'relation_type',
    ];

    public function platform()
    {
        return $this->belongsTo(GamePlatform::class);
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
