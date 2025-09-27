<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(count: 300)->create()->each(
            callback: function (Post $post): void {
                $tags = Tag::inRandomOrder()->take(value: rand(min: 1, max: 5))->pluck(column: 'id');

                $post->tags()->attach(ids: $tags);
            }
        );
    }
}
