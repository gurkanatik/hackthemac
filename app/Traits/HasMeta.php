<?php

namespace App\Traits;

use App\Models\MetaRelation;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasMeta
{
    public function meta(): MorphOne
    {
        return $this->morphOne(MetaRelation::class, 'relation');
    }
}
