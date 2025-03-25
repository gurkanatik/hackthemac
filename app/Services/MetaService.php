<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class MetaService
{
    public static function save(Model $model, array $metaData): void
    {
        $model->meta()->updateOrCreate(
            [],
            [
                'meta_title' => $metaData['meta_title'] ?? null,
                'meta_description' => $metaData['meta_description'] ?? null,
                'meta_keywords' => $metaData['meta_keywords'] ?? null,
            ]
        );
    }
}
