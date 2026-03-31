<?php

namespace Database\Seeders;

use App\Models\Cohort;
use App\Models\Center;
use Illuminate\Database\Seeder;

class CohortSeeder extends Seeder
{
    public function run(): void
    {
        $cohorts = [
            [
                'cohort_number' => 'COH-2024-001',
                'program_name' => 'Desarrollo Web Full Stack',
                'center_id' => 1,
                'start_date' => '2024-03-01',
                'end_date' => '2024-09-30'
            ],
            [
                'cohort_number' => 'COH-2024-002',
                'program_name' => 'Data Science y Analytics',
                'center_id' => 2,
                'start_date' => '2024-04-01',
                'end_date' => '2024-10-31'
            ],
            [
                'cohort_number' => 'COH-2024-003',
                'program_name' => 'Desarrollo Móvil Android',
                'center_id' => 3,
                'start_date' => '2024-03-15',
                'end_date' => '2024-09-15'
            ],
            [
                'cohort_number' => 'COH-2024-004',
                'program_name' => 'UX/UI Design',
                'center_id' => 4,
                'start_date' => '2024-05-01',
                'end_date' => '2024-11-30'
            ],
            [
                'cohort_number' => 'COH-2024-005',
                'program_name' => 'DevOps y Cloud Computing',
                'center_id' => 5,
                'start_date' => '2024-06-01',
                'end_date' => '2024-12-15'
            ],
            [
                'cohort_number' => 'COH-2025-001',
                'program_name' => 'Desarrollo Web Full Stack',
                'center_id' => 1,
                'start_date' => '2025-01-15',
                'end_date' => '2025-07-15'
            ],
            [
                'cohort_number' => 'COH-2025-002',
                'program_name' => 'Inteligencia Artificial',
                'center_id' => 2,
                'start_date' => '2025-02-01',
                'end_date' => '2025-08-31'
            ],
            [
                'cohort_number' => 'COH-2025-003',
                'program_name' => 'Ciberseguridad',
                'center_id' => 3,
                'start_date' => '2025-03-01',
                'end_date' => '2025-09-30'
            ],
        ];

        foreach ($cohorts as $cohort) {
            Cohort::create($cohort);
        }
        
        // Crear cohorts adicionales con factory si se necesitan más
        if (env('APP_ENV') !== 'production') {
            Cohort::factory(5)->create();
        }
    }
}