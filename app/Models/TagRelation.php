<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagRelation extends Model
{
    protected $fillable = [
        'tag_id',
        'relation_id',
        'relation_type',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
