<?php

namespace App\Services;

use App\Models\GameGenreRelation;
use Illuminate\Database\Eloquent\Model;

class GameGenreService
{
    public static function sync(Model $model, array $genreIds): void
    {
        $model->genreRelations()->delete();

        foreach ($genreIds as $genreId) {
            GameGenreRelation::create([
                'game_genre_id' => $genreId,
                'relation_id' => $model->id,
                'relation_type' => get_class($model),
            ]);
        }
    }
}
