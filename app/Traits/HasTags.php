<?php

namespace App\Traits;

use App\Models\Tag;
use App\Models\TagRelation;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasTags
{
    public function tagRelations(): MorphMany
    {
        return $this->morphMany(TagRelation::class, 'relation');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_relations', 'relation_id', 'tag_id')
            ->where('tag_relations.relation_type', static::class);
    }
}
