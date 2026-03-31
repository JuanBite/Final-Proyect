<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', '+3 months');
        $dueDate = $this->faker->dateTimeBetween($startDate, '+3 months');
        
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'due_date' => $dueDate,
            'progress' => $this->faker->randomFloat(2, 0, 100),
            'leader_id' => User::factory()->instructor(),
            'status' => $this->faker->randomElement(['IN_PROGRESS', 'COMPLETED', 'DELAYED']),
            'created_at' => now(),
        ];
    }

    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'IN_PROGRESS',
            'progress' => $this->faker->randomFloat(2, 1, 99),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'COMPLETED',
            'progress' => 100.00,
        ]);
    }
}