<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaRelation extends Model
{
    protected $fillable = [
        'relation_id',
        'relation_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
