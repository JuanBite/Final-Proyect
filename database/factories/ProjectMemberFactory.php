<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMemberFactory extends Factory
{
    protected $model = ProjectMember::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'user_id' => User::factory()->student(),
            'project_role' => $this->faker->randomElement(['LEADER', 'MEMBER']),
        ];
    }

    public function leader(): static
    {
        return $this->state(fn (array $attributes) => [
            'project_role' => 'LEADER',
        ]);
    }

    public function member(): static
    {
        return $this->state(fn (array $attributes) => [
            'project_role' => 'MEMBER',
        ]);
    }
}