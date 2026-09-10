<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogContentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Teaching', 'description' => 'Bible-based teachings and doctrinal instruction.'],
            ['name' => 'Testimony', 'description' => 'Stories of what God has done among us.'],
            ['name' => 'Outreach', 'description' => 'Updates and reports from our evangelism and missions work.'],
            ['name' => 'Prayer', 'description' => 'Prayer focuses, patterns, and invitations to the altar.'],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => true,
                ]
            );
        }

        $tags = [
            'Midnight Watch',
            'Intercession',
            'Unreached',
            'Missions',
            'Divine Connection',
            'Testimony',
            'Outreach',
            'Prayer',
            'Breakthrough',
            'Watchman',
        ];

        foreach ($tags as $tag) {
            BlogTag::updateOrCreate(
                ['slug' => Str::slug($tag)],
                ['name' => $tag]
            );
        }
    }
}
