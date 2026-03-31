<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Cohort;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $role = $this->faker->randomElement(['ADMIN', 'INSTRUCTOR', 'STUDENT']);
        
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => $role,
            'status' => $this->faker->boolean(90), // 90% de probabilidad de estar activo
            'cohort_id' => $role === 'STUDENT' ? Cohort::factory() : null,
            'created_at' => now(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'ADMIN',
            'cohort_id' => null,
        ]);
    }

    public function instructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'INSTRUCTOR',
            'cohort_id' => null,
        ]);
    }

    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'STUDENT',
        ]);
    }
}