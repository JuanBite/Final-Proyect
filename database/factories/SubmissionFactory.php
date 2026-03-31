<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    public function definition(): array
    {
        $submittedAt = $this->faker->dateTimeBetween('-1 month', 'now');
        $hasGrade = $this->faker->boolean(70);
        
        return [
            'project_id' => Project::factory(),
            'file_path' => $this->faker->filePath(),
            'comments' => $this->faker->paragraph(),
            'submitted_at' => $submittedAt,
            'grade' => $hasGrade ? $this->faker->randomFloat(2, 0, 100) : null,
            'feedback' => $hasGrade ? $this->faker->paragraph() : null,
        ];
    }

    public function graded(): static
    {
        return $this->state(fn (array $attributes) => [
            'grade' => $this->faker->randomFloat(2, 0, 100),
            'feedback' => $this->faker->paragraph(),
        ]);
    }

    public function ungraded(): static
    {
        return $this->state(fn (array $attributes) => [
            'grade' => null,
            'feedback' => null,
        ]);
    }
}