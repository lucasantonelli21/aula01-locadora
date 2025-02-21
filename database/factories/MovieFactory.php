<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\IsTrue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "action",
            "adventure",
            "horror",
            "romance",
            "mistery",
            "comedy"
        ];
        return [
            'name' => fake()->name(),
            'category' => $categories[rand(0,4)],
            'age_indication' => rand(10,18),
            'duration' => rand(60,180),
            'release_date' => now(),
            'description' => Str::random(100),
            'is_fan' => true

        ];
    }
}
