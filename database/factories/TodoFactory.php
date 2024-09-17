<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'completed' => false,
            'user_id' => 1,
        ];
    }
}
