<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameGenreRelation extends Model
{
    protected $fillable = [
        'game_genre_id',
        'relation_id',
        'relation_type',
    ];

    public function genre()
    {
        return $this->belongsTo(GameGenre::class, 'game_genre_id');
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
