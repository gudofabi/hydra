<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 comments for each specified task ID
        Comment::factory()->count(5)->state([
            'task_id' => 10,
        ])->create();

        Comment::factory()->count(5)->state([
            'task_id' => 11,
        ])->create();
    }
}
