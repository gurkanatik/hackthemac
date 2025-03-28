<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Platform;
use App\Models\Publisher;
use App\Models\PlatformRelation;
use App\Models\Tag;
use App\Models\TagRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = Publisher::pluck('id')->toArray();
        $platforms = Platform::pluck('id')->toArray();
        $tags = Tag::pluck('id')->toArray();

        $apps = [
            'Slack', 'Notion', 'Spotify', 'Figma', 'Discord',
            'Zoom', 'Visual Studio Code', 'Postman', 'iTerm2', 'Alfred',
            '1Password', 'Bitwarden', 'Docker Desktop', 'TablePlus', 'Raycast',
            'Kap', 'Grammarly', 'CleanShot X', 'Todoist', 'Magnet'
        ];

        foreach ($apps as $title) {
            $app = App::create([
                'publisher_id' => fake()->randomElement($publishers),
                'title' => $title,
                'slug' => Str::slug($title),
                'cover_image' => null,
                'excerpt' => fake()->sentence(10),
                'content' => fake()->paragraph(5),
                'mac_support' => fake()->numberBetween(0, 3),
                'price' => fake()->randomFloat(2, 0, 29.99),
                'is_active' => true,
                'published_at' => now()->subDays(fake()->numberBetween(0, 365)),
                'release_date' => now()->subDays(fake()->numberBetween(0, 700))->toDateString(),
            ]);

            // Tags
            foreach (fake()->randomElements($tags, rand(1, 3)) as $tagId) {
                TagRelation::create([
                    'tag_id' => $tagId,
                    'relation_id' => $app->id,
                    'relation_type' => App::class,
                ]);
            }

            // Platforms
            foreach (fake()->randomElements($platforms, rand(1, 3)) as $platformId) {
                PlatformRelation::create([
                    'platform_id' => $platformId,
                    'relation_id' => $app->id,
                    'relation_type' => App::class,
                ]);
            }
        }
    }
}
