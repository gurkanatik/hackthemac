<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'About Us',
            'Privacy Policy',
            'Terms of Service',
            'Contact',
            'FAQ',
            'Cookie Policy',
        ];

        foreach ($pages as $title) {
            Page::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'content' => '<h1>' . e($title) . '</h1>',
                    'is_active' => true,
                ]
            );
        }
    }
}
