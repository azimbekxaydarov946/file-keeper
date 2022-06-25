<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Home>
 */
class HomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'title' => $this->faker->title(),
            'file' => $this->faker->filePath(),
            'date' => $this->faker->date(),
            'category_id' =>  $this->faker->numberBetween(1, 4),
            'status' => $this->faker->boolean()
        ];
    }
}
