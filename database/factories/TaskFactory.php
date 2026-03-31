<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $project = Project::factory()->create();
        
        return [
            'project_id' => $project->id,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->dateTimeBetween($project->start_date, $project->due_date),
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'status' => $this->faker->randomElement(['PENDING', 'IN_PROGRESS', 'COMPLETED']),
            'assigned_to' => User::factory()->student(),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'PENDING',
        ]);
    }

    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'IN_PROGRESS',
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'COMPLETED',
        ]);
    }
}