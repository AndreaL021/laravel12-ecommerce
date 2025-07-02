<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        return [
            'title'      => $this->faker->word(),
            'des'        => $this->faker->paragraph(),
            'price'      => $this->faker->randomFloat(2, 1, 9999),
        ];
    }

    public function withCategories(int $count = 2): static
    {
        return $this->afterCreating(function (Announcement $announcement) use ($count) {
            $categories = \App\Models\Category::inRandomOrder()->limit($count)->pluck('id');
            $announcement->categories()->attach($categories);
        });
    }

    public function withImages(int $count = 3): static
    {
        return $this->afterCreating(function (Announcement $announcement) use ($count) {
            \App\Models\AnnouncementImage::factory()
                ->count($count)
                ->create(['announcement_id' => $announcement->id]);
        });
    }
}
