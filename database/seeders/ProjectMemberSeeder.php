<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectMember;
use Illuminate\Database\Seeder;

class ProjectMemberSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $students = User::where('role', 'STUDENT')->get();
        
        foreach ($projects as $project) {
            // Agregar al líder como miembro
            ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $project->leader_id,
                'project_role' => 'LEADER',
            ]);
            
            // Seleccionar estudiantes aleatorios para el proyecto
            $projectStudents = $students->random(min(5, $students->count()));
            
            foreach ($projectStudents as $student) {
                // Verificar que no sea el líder
                if ($student->id != $project->leader_id) {
                    ProjectMember::firstOrCreate([
                        'project_id' => $project->id,
                        'user_id' => $student->id,
                    ], [
                        'project_role' => 'MEMBER',
                    ]);
                }
            }
        }
        
        // Agregar miembros adicionales con factory
        if (env('APP_ENV') !== 'production') {
            ProjectMember::factory(30)->create();
        }
    }
}