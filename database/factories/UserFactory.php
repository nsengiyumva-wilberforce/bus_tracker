<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // or use Hash::make('password') if importing
            'remember_token' => Str::random(10),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
