<?php

namespace App\Services;

use App\Models\PlatformRelation;
use Illuminate\Database\Eloquent\Model;

class PlatformService
{
    public static function sync(Model $model, array $platformIds): void
    {
        $model->platformRelations()->delete();

        foreach ($platformIds as $platformId) {
            PlatformRelation::create([
                'platform_id' => $platformId,
                'relation_id' => $model->id,
                'relation_type' => get_class($model),
            ]);
        }
    }
}
