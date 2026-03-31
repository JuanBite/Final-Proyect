<?php

namespace Database\Factories;

use App\Models\Cohort;
use App\Models\Center;
use Illuminate\Database\Eloquent\Factories\Factory;

class CohortFactory extends Factory
{
    protected $model = Cohort::class;

    public function definition(): array
    {
        $year = $this->faker->numberBetween(2023, 2026);
        $number = $this->faker->numberBetween(1, 10);
        
        return [
            'cohort_number' => $this->faker->unique()->bothify("COH-{$year}-{$number}"),
            'program_name' => $this->faker->randomElement(['Web Development', 'Data Science', 'Mobile Development', 'UX/UI Design']),
            'center_id' => Center::factory(),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}