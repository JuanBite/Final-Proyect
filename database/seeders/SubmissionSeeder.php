<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        
        foreach ($projects as $project) {
            $hasSubmission = true;
            $isGraded = $project->status === 'COMPLETED';
            
            if ($hasSubmission) {
                Submission::create([
                    'project_id' => $project->id,
                    'file_path' => "projects/project_{$project->id}_submission.zip",
                    'comments' => $isGraded 
                        ? 'Entrega final completa con todas las funcionalidades solicitadas.' 
                        : 'Entrega parcial, faltan algunas funcionalidades por completar.',
                    'submitted_at' => $project->due_date,
                    'grade' => $isGraded ? rand(65, 95) : null,
                    'feedback' => $isGraded 
                        ? 'Excelente trabajo! Cumple con todos los requisitos. Se recomienda mejorar la documentación.' 
                        : null,
                ]);
            }
        }
        
        // Crear entregas adicionales con factory
        if (env('APP_ENV') !== 'production') {
            Submission::factory(20)->create();
        }
    }
}