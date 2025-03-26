<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Publisher;
use Carbon\Carbon;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            "Nintendo", "Sony Interactive Entertainment", "Microsoft Studios",
            "Electronic Arts", "Activision", "Ubisoft", "Square Enix",
            "Bethesda Softworks", "Bandai Namco", "SEGA", "Capcom", "Rockstar Games",
            "Take-Two Interactive", "2K Games", "Blizzard Entertainment", "Valve",
            "Konami", "CD Projekt", "Paradox Interactive", "Warner Bros. Games",
            "Riot Games", "Epic Games", "THQ Nordic", "Focus Entertainment", "Devolver Digital",
            "Remedy Entertainment", "Telltale Games", "Crytek", "Atlus", "Gearbox Publishing",
            "Koei Tecmo", "Nexon", "NetEase", "Tencent Games", "Zynga", "Supercell",
            "Insomniac Games", "id Software", "Obsidian Entertainment", "Monolith Productions",
            "IO Interactive", "Creative Assembly", "Playdead", "Double Fine Productions",
            "FromSoftware", "Tango Gameworks", "Bluehole Studio", "Pearl Abyss", "Larian Studios",
            "Techland", "Dontnod Entertainment", "Level-5", "Grasshopper Manufacture", "PlatinumGames",
            "Arc System Works", "Hello Games", "Cygames", "InXile Entertainment", "Rebellion",
            "Avalanche Studios", "Team17", "Relic Entertainment", "Housemarque", "Milestone",
            "Behaviour Interactive", "Naughty Dog", "Polyphony Digital", "Game Freak", "Camelot Software Planning",
            "Infinity Ward", "Treyarch", "Sucker Punch Productions", "Bend Studio", "Media Molecule",
            "Santa Monica Studio", "Guerrilla Games", "Bluepoint Games", "Asobo Studio", "Deck Nine",
            "Dontnod", "Psyonix", "Volition", "Criterion Games", "Ghost Games", "Petroglyph Games",
            "Arkane Studios", "Ember Lab", "Bloober Team", "Red Barrels", "Playrix",
            "King", "Scopely", "GungHo Online", "GameLoft", "Madfinger Games", "Nicalis",
            "Frozenbyte", "Subset Games", "Stoic Studio", "Motion Twin"
        ];

        foreach ($publishers as $title) {
            Publisher::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'excerpt' => "$title is a leading game publisher.",
                'content' => "<p>$title has published some of the most iconic games in the industry.</p>",
                'publisher_type' => 'game',
                'is_active' => true,
                'published_at' => Carbon::parse('2024-01-01 00:00:00'),
            ]);
        }
    }
}
