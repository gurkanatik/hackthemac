<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Publisher;
use App\Models\GamePlatform;
use App\Models\GameGenre;
use App\Models\GameGenreRelation;
use App\Models\GamePlatformRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = Publisher::pluck('id')->toArray();
        $genres = GameGenre::pluck('id')->toArray();
        $platforms = GamePlatform::pluck('id')->toArray();

        $games = [
            'Elden Ring', 'God of War', 'The Witcher 3', 'Cyberpunk 2077', 'Hades',
            'Hogwarts Legacy', 'Baldur\'s Gate 3', 'Sekiro', 'Red Dead Redemption 2', 'Assassin\'s Creed Valhalla',
            'Horizon Zero Dawn', 'Spider-Man', 'Death Stranding', 'Resident Evil Village', 'Doom Eternal',
            'Control', 'Final Fantasy XVI', 'Starfield', 'Alan Wake 2', 'Atomic Heart'
        ];

        foreach ($games as $title) {
            $game = Game::create([
                'publisher_id' => fake()->randomElement($publishers),
                'title' => $title,
                'slug' => Str::slug($title),
                'cover_image' => null,
                'excerpt' => fake()->sentence(10),
                'content' => fake()->paragraph(5),
                'mac_support' => fake()->numberBetween(0, 3),
                'price' => fake()->randomFloat(2, 9.99, 69.99),
                'metacritic_rate' => fake()->numberBetween(60, 97),
                'steam_rate' => fake()->numberBetween(60, 97),
                'opencritic_rate' => fake()->numberBetween(60, 97),
                'is_active' => true,
                'published_at' => now()->subDays(fake()->numberBetween(0, 300)),
                'release_date' => now()->subDays(fake()->numberBetween(0, 600))->toDateString(),
            ]);

            // Genres
            foreach (fake()->randomElements($genres, rand(1, 3)) as $genreId) {
                GameGenreRelation::create([
                    'game_genre_id' => $genreId,
                    'relation_id' => $game->id,
                    'relation_type' => Game::class,
                ]);
            }

            // Platforms
            foreach (fake()->randomElements($platforms, rand(1, 3)) as $platformId) {
                GamePlatformRelation::create([
                    'platform_id' => $platformId,
                    'relation_id' => $game->id,
                    'relation_type' => Game::class,
                ]);
            }
        }
    }
}
