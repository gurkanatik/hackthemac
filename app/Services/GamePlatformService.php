<?php

namespace App\Services;

use App\Models\GamePlatformRelation;
use Illuminate\Database\Eloquent\Model;

class GamePlatformService
{
    public static function sync(Model $model, array $platformIds): void
    {
        $model->platformRelations()->delete();

        foreach ($platformIds as $platformId) {
            GamePlatformRelation::create([
                'platform_id' => $platformId,
                'relation_id' => $model->id,
                'relation_type' => get_class($model),
            ]);
        }
    }
}
