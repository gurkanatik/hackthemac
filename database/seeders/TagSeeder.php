<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Steam', 'Epic Games', 'GOG', 'Origin', 'Uplay', 'Battle.net',
            'Xbox', 'PlayStation', 'Nintendo Switch', 'PC', 'Mac', 'Linux',
            'Android', 'iOS', 'Google Stadia', 'GeForce Now', 'Amazon Luna',

            'Action', 'Adventure', 'RPG', 'JRPG', 'MMORPG', 'FPS', 'TPS', 'Platformer',
            'Puzzle', 'Strategy', 'Simulation', 'Sports', 'Racing', 'Fighting', 'Stealth',
            'Survival', 'Horror', 'Roguelike', 'Roguelite', 'Sandbox', 'Open World',
            'Metroidvania', 'Visual Novel', 'Idle Game', 'Point and Click', 'Tactical',

            'Singleplayer', 'Multiplayer', 'Co-op', 'Online Co-op', 'Local Co-op', 'PvP',
            'PvE', 'Crossplay', 'Turn-Based', 'Real-Time', 'Card Game', 'Deckbuilding',
            'Competitive', 'Casual', 'Hardcore', 'Esports', 'Controller Support',
            'VR Support', 'Cloud Save', 'Achievements',

            'Fantasy', 'Sci-Fi', 'Post-Apocalyptic', 'Cyberpunk', 'Historical', 'Military',
            'Western', 'Space', 'Underwater', 'Medieval', 'Modern Warfare', 'Future',
            'Supernatural', 'Superhero', 'Dystopian',

            'Early Access', 'Free to Play', 'Pay to Play', 'Demo Available', 'Subscription',
            'Game Pass', 'Beta', 'Alpha', 'Indie', 'AAA', 'Remake', 'Remaster', 'Classic',
            'New Release', 'Trending', 'Popular', 'Limited Time',

            'Mod Support', 'Workshop', 'Streamer Friendly', 'Speedrun Friendly',
            'Leaderboards', 'Custom Maps', 'User Generated Content', 'Clan System',
            'Guilds', 'In-Game Chat', 'Voice Chat', 'Replay System',

            'Low Spec', 'High-End Graphics', 'Ray Tracing', 'Unreal Engine', 'Unity',
            'Native Mac Support', 'Mac Emulator', 'Wine Compatible', 'ProtonDB Gold',
            'Controller Required', '60 FPS', 'Ultrawide', 'Split Screen', 'LAN Play',
            'Online Matchmaking', 'Dedicated Servers',

            'Discount', 'Steam Sale', 'Epic Free Game', 'Top Seller', 'New & Noteworthy',
            'Editor\'s Choice', 'Hidden Gem', 'Award Winner', 'Critically Acclaimed',
            'Viral', 'Meme Game',

            'Story Rich', 'Narrative Driven', 'Choices Matter', 'Multiple Endings',
            'Dating Sim', 'Romance', 'Dark Story', 'Comedy', 'Drama', 'Emotional',
            'Psychological', 'Character Driven',

            'Zombie', 'Vampire', 'Mecha', 'Ninja', 'Samurai', 'Pirates', 'Time Travel',
            'Hacking', 'Detective', 'Heist', 'Building', 'Crafting', 'Farming', 'Fishing',
            'Cooking', 'Mining', 'Trading', 'Tycoon', 'City Builder', 'Space Sim',

            'For Kids', 'Family Friendly', 'Educational', 'Relaxing', 'Atmospheric',
            'Challenging', 'Competitive Multiplayer', 'Couch Co-op',
            'Party Game', 'Replayable', 'Short Game', 'Long Campaign',

            'First Person', 'Third Person', 'Top Down', 'Isometric', 'Pixel Art', '2D',
            '3D', 'Anime Style', 'Stylized', 'Realistic', 'Retro', 'Minimalist',
            'Experimental', 'Puzzle Platformer', 'Endless Runner', 'Dark Fantasy'
        ];

        foreach ($tags as $index => $title) {
            Tag::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'order_num' => $index,
            ]);
        }
    }
}
