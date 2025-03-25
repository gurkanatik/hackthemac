<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function meta()
    {
        return $this->morphOne(\App\Models\MetaRelation::class, 'relation');
    }

    public function tagRelations()
    {
        return $this->morphMany(TagRelation::class, 'relation');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_relations', 'relation_id', 'tag_id')
            ->where('tag_relations.relation_type', self::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('order', function ($query) {
            $query->orderByDesc('published_at')->orderByDesc('id');
        });
    }
}
