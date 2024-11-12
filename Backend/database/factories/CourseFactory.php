<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'category_id' => Category::factory(), // Generates a related Category
            'title' => $this->faker->sentence(3), // Random title of 3 words
            'description' => $this->faker->paragraph, // Random paragraph for description
            'price' => $this->faker->randomFloat(2, 10, 500), // Random price between 10 and 500 with 2 decimal points
            'lessons' => $this->faker->numberBetween(5, 50), // Random number of lessons between 5 and 50
            'rating' => $this->faker->randomFloat(1, 0, 5), // Random rating between 0 and 5 with 1 decimal point
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
