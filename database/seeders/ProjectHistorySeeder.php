<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectHistory;
use Illuminate\Database\Seeder;

class ProjectHistorySeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();
        
        $actions = [
            'Proyecto creado',
            'Líder asignado',
            'Miembros agregados al proyecto',
            'Estado actualizado a EN PROGRESO',
            'Tarea completada: Diseño de base de datos',
            'Progreso actualizado',
            'Entrega parcial realizada',
            'Revisión de avance',
            'Estado actualizado a COMPLETADO',
            'Entrega final evaluada',
            'Retroalimentación proporcionada',
        ];
        
        foreach ($projects as $project) {
            // Crear historial para cada proyecto
            $numHistory = rand(3, 8);
            $startDate = $project->created_at;
            
            for ($i = 0; $i < $numHistory; $i++) {
                $actionDate = $startDate->copy()->addDays(rand(1, 30 * $i));
                
                ProjectHistory::create([
                    'project_id' => $project->id,
                    'action' => $actions[array_rand($actions)],
                    'performed_by' => $users->random()->id,
                    'created_at' => $actionDate,
                ]);
            }
        }
        
        // Crear historial adicional con factory
        if (env('APP_ENV') !== 'production') {
            ProjectHistory::factory(50)->create();
        }
    }
}