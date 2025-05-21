<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Untuk setiap user, buat 3 post dengan status berbeda
        User::all()->each(function ($user) {
            Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

            Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'scheduled',
                'published_at' => now()->addDays(3),
            ]);

            Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
            ]);
        });
    }
}
