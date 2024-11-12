<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => '0' . fake()->numerify(fake()->boolean ? '#########' : '##########'), // Either 9 or 10 digits
            'email_verified_at' => now(),
            'password' => "admin1234",
            // 'role' => fake()->randomElement([1, 2]), // Randomly assign either "Student" or "Teacher"
            // 'gender' => fake()->randomElement(['Male', 'Female']), // Example gender options
            'address' => fake()->address(), // Generate a random address
            'date_of_birth' => fake()->date(),
            'remember_token' => Str::random(10),
        ];
        // static::$password ??= Hash::make('password'),
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
