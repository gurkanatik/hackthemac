<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\TagRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $title = fake()->sentence(5);

            $blog = BlogPost::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'cover_image' => null,
                'excerpt' => fake()->sentence(12),
                'content' => fake()->paragraphs(5, true),
                'is_active' => fake()->boolean(90),
                'published_at' => now()->subDays(fake()->numberBetween(1, 300)),
            ]);

            // Tags
            foreach (fake()->randomElements($tags, rand(1, 3)) as $tagId) {
                TagRelation::create([
                    'tag_id' => $tagId,
                    'relation_id' => $blog->id,
                    'relation_type' => BlogPost::class,
                ]);
            }
        }
    }
}
