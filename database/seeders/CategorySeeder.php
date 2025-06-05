<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private $defaultCategories = [
        'Personal',
        'Work',
        'Shopping',
        'Travel',
        'Others',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            foreach ($this->defaultCategories as $category) {
                $user->categories()->create([
                    'name' => $category,
                ]);
            }
        });
    }
}
