<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create('pt_BR');

        return [
            'name' => $faker->name(),
            'email' => fake()->email(),
            'birth_date' => now()->subYear(10),
            'cpf' => $faker->cpf(),
            'phone' => $faker->cellphoneNumber(),
            'able' => true
        ];
    }

}
