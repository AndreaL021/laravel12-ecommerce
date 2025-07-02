<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Prima popola le categorie
        $this->call(CategorySeeder::class);

        // Poi crea utenti e annunci
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                Announcement::factory()
                    ->count(3)
                    ->for($user)
                    ->withCategories(2) 
                    ->withImages(3)    
                    ->create();
            });
    }
}
