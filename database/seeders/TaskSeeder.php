<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $user->categories()->each(function ($category) use ($user) {
                Task::factory()->count(5)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
            });
        });
    }
}
