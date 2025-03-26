<?php

namespace Database\Seeders;

use App\Models\GamePlatform;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            'Windows',
            'macOS',
            'Linux',
            'PlayStation 5',
            'PlayStation 4',
            'PlayStation 3',
            'Xbox Series X',
            'Xbox One',
            'Xbox 360',
            'Nintendo Switch',
            'Nintendo Wii U',
            'Nintendo Wii',
            'Steam Deck',
            'iOS',
            'Android',
            'Web Browser',
            'PlayStation Vita',
            'Nintendo 3DS',
            'Google Stadia',
            'Amazon Luna',
            'Oculus Rift',
            'HTC Vive',
            'Meta Quest',
            'Atari 2600',
            'Commodore 64',
        ];

        foreach ($platforms as $title) {
            GamePlatform::updateOrCreate(
                ['slug' => Str::slug($title)],
                ['title' => $title]
            );
        }
    }
}
