<?php

namespace App\Services;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Model;

class TagService
{
    /**
     * @param Model&HasTags $model
     */
    public static function sync(Model $model, array $tagIds): void
    {
        $model->tagRelations()->delete();

        foreach ($tagIds as $tagId) {
            $model->tagRelations()->create([
                'tag_id' => $tagId,
            ]);
        }
    }
}
