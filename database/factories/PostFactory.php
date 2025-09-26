<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Enums\PostSource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  User::inRandomOrder()->value(column: 'id'),
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'body' => $this->faker->paragraphs(nb: 5, asText: true),
            'published_at' => Carbon::parse($this->faker->dateTimeBetween('-1 month', '+1 month')),
            'source' => PostSource::SEED,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
