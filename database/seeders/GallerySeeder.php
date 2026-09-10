<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Seed the gallery with the ministry's supplied photographs.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fellowship & Gatherings',
                'slug' => 'fellowship-gatherings',
                'description' => 'Moments from JIZIM fellowship meetings and gatherings.',
                'from' => 1,
                'to' => 4,
                'cover' => 'preview-1.jpg',
            ],
            [
                'name' => 'Outreaches',
                'slug' => 'outreaches',
                'description' => 'Medical, food, and missionary outreaches across Nigeria.',
                'from' => 5,
                'to' => 12,
                'cover' => 'preview-7.jpg',
            ],
        ];

        $altTexts = [
            1 => 'Joy In Zoe fellowship gathering',
            2 => 'Members gathered in fellowship',
            3 => 'Joy In Zoe fellowship moment',
            4 => 'Intercessors at a ministry gathering',
            5 => 'Outreach in Ada-Irri, Delta State',
            6 => 'Missionaries during Delta outreach',
            7 => 'Community outreach in Gwagwalada, Abuja',
            8 => 'Gwagwalada outreach ministry',
            9 => 'Kwara State missionary outreach',
            10 => 'Medical outreach in Gwagwalada, Abuja',
            11 => 'Food outreach serving a community',
            12 => 'Joy In Zoe missionary team',
        ];

        foreach ($categories as $category) {
            $model = GalleryCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'cover_image' => "gallery/{$category['cover']}",
                    'is_active' => true,
                ]
            );

            for ($i = $category['from']; $i <= $category['to']; $i++) {
                $filename = "preview-{$i}.jpg";
                $path = "gallery/{$filename}";

                GalleryImage::updateOrCreate(
                    ['path' => $path],
                    [
                        'gallery_category_id' => $model->id,
                        'title' => Str::title($altTexts[$i] ?? "Ministry moment {$i}"),
                        'alt_text' => $altTexts[$i] ?? "Joy In Zoe ministry photograph {$i}",
                        'filename' => $filename,
                        'mime_type' => 'image/jpeg',
                        'size' => filesize(public_path("images/gallery/{$filename}")),
                        'is_published' => true,
                    ]
                );
            }
        }
    }
}
