<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => null,
            'last_name' => fake()->lastName(),
            'title' => fake()->optional(0.6)->title()
        ];
    }

    public function forUser($user): ProfileFactory
    {
        return $this->state(
            state: fn(): array => [
                'user_id'    => $user->id,
                'first_name' => $user->name,
            ]
        );
    }
}
