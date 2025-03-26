<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TagSeeder::class,
            PageSeeder::class,
            PublisherSeeder::class,
            PlatformSeeder::class,
            GameGenreSeeder::class,
            GameSeeder::class,
        ]);
    }

}
