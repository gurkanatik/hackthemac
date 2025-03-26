<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GameGenre;
use Illuminate\Support\Str;

class GameGenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Action', 'Adventure', 'Role-Playing', 'Shooter', 'Simulation', 'Strategy', 'Sports',
            'Puzzle', 'Racing', 'Fighting', 'Survival', 'Platformer', 'Stealth', 'Horror', 'Sandbox',
            'Open World', 'MMORPG', 'MOBA', 'Battle Royale', 'Visual Novel', 'Tactical', 'Turn-Based Strategy',
            'Real-Time Strategy', 'City Builder', 'Tower Defense', 'Roguelike', 'Roguelite', 'Card Game',
            'Board Game', 'Trivia', 'Music', 'Party Game', 'Point & Click', 'Metroidvania', 'Soulslike',
            '4X', 'Idle', 'Text-Based', 'Hack and Slash', 'Bullet Hell', 'Walking Simulator', 'Interactive Fiction',
            'JRPG', 'Western RPG', 'Life Sim', 'Dating Sim', 'Economic Sim', 'Crime', 'Detective',
            'Historical', 'Sci-Fi', 'Fantasy', 'Post-Apocalyptic', 'Cyberpunk', 'Steampunk', 'Mystery',
            'Espionage', 'Naval', 'Air Combat', 'Space Combat', 'Vehicular Combat', 'Skateboarding',
            'Snowboarding', 'Skiing', 'Baseball', 'Basketball', 'Football (Soccer)', 'American Football',
            'Tennis', 'Golf', 'Boxing', 'Wrestling', 'Martial Arts', 'Fishing', 'Hunting', 'Arcade',
            'Educational', 'Kids', 'Indie', 'Classic', 'Retro', 'Pixel Art', '3D', '2D', 'Top-Down',
            'First-Person', 'Third-Person', 'Side-Scrolling', 'Isometric', 'Split-Screen', 'Co-op',
            'Multiplayer', 'Singleplayer', 'Local Multiplayer', 'Online Multiplayer', 'Text Adventure',
            'Art Game', 'Experimental'
        ];

        foreach ($genres as $title) {
            GameGenre::firstOrCreate([
                'slug' => Str::slug($title),
            ], [
                'title' => $title,
            ]);
        }
    }
}
