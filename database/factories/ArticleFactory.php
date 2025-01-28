<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'slug' => fake()->slug(),
            'content' => fake()->realText(1500),
            'author_id' => fake()->numberBetween(1, 10),
            'published_at' => fake()->optional()->dateTime,
            'deleted_at' => fake()->optional()->dateTime,
        ];
    }

    public function published(): Factory
    {
        return $this->state([
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    public function draft(): Factory
    {
        return $this->state([
            'published_at' => null,
        ]);
    }

    public function nodeleted(): Factory
    {
        return $this->state([
            'deleted_at' => null,
        ]);
    }
}
