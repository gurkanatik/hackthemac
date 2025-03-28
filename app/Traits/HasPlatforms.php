<?php

namespace App\Traits;

use App\Models\Platform;
use App\Models\PlatformRelation;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPlatforms
{
    public function platformRelations(): MorphMany
    {
        return $this->morphMany(PlatformRelation::class, 'relation');
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'platform_relations', 'relation_id', 'platform_id')
            ->where('platform_relations.relation_type', static::class);
    }
}
