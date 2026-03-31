<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectHistoryFactory extends Factory
{
    protected $model = ProjectHistory::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'action' => $this->faker->randomElement([
                'Created', 'Updated', 'Status Changed', 'Member Added', 
                'Member Removed', 'Task Completed', 'Submission Uploaded'
            ]),
            'performed_by' => User::factory(),
            'created_at' => now(),
        ];
    }
}