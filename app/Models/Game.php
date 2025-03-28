<?php

namespace App\Models;

namespace App\Models;

use App\Traits\HasPlatforms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Traits\HasTags;
use App\Traits\HasMeta;
use App\Traits\HasCoverImage;

class Game extends Model
{
    use HasTags, HasMeta, HasCoverImage, HasPlatforms;

    protected $fillable = [
        'publisher_id',
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'content',
        'mac_support',
        'price',
        'metacritic_rate',
        'steam_rate',
        'opencritic_rate',
        'is_active',
        'published_at',
        'release_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'release_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('id');
        });
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genreRelations(): MorphMany
    {
        return $this->morphMany(GameGenreRelation::class, 'relation');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(GameGenre::class, 'game_genre_relations', 'relation_id', 'game_genre_id')
            ->where('game_genre_relations.relation_type', static::class);
    }

}
