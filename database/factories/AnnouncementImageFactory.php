<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\AnnouncementImage;
use Illuminate\Database\Eloquent\Factories\Factory;


class AnnouncementImageFactory extends Factory
{
    protected $model = AnnouncementImage::class;

    public function definition(): array
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

        $allFiles = [];

        foreach ($imageExtensions as $ext) {
            $allFiles = array_merge($allFiles, glob(storage_path("app/public/images/*.{$ext}")));
        }

        $filename = basename(fake()->randomElement($allFiles));

        return [
            'path' => 'images/' . $filename,
        ];
    }
}
