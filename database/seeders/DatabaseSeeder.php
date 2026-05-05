<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Category::create([
        //     'name' => 'Category 1',
        //     'description' => 'This is Category 1 description'
        // ]);

        Category::insert([
            [
                'name' => 'Category 2',
                'description' => 'This is Category 2 description',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Category 3',
                'description' => 'This is Category 3 description',
                'created_at' => now(),
                'updated_at' => now()
            ], 
            [
                'name' => 'Category 4',
                'description' => 'This is Category 4 description',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}