<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $students = User::where('role', 'STUDENT')->get();
        
        $tasks = [];
        
        foreach ($projects as $project) {
            $projectMembers = $project->members->pluck('id')->toArray();
            $availableMembers = array_intersect($students->pluck('id')->toArray(), $projectMembers);
            
            // Tareas para proyecto 1
            if ($project->id == 1) {
                $tasks = array_merge($tasks, [
                    [
                        'project_id' => $project->id,
                        'title' => 'Diseño de base de datos',
                        'description' => 'Crear el modelo entidad-relación y normalizar la base de datos.',
                        'start_date' => '2024-03-01 09:00:00',
                        'due_date' => '2024-03-15 23:59:59',
                        'status' => 'COMPLETED',
                        'assigned_to' => $availableMembers[0] ?? null,
                    ],
                    [
                        'project_id' => $project->id,
                        'title' => 'Desarrollo del backend con Laravel',
                        'description' => 'Implementar API REST con autenticación y CRUD de tareas.',
                        'start_date' => '2024-03-16 09:00:00',
                        'due_date' => '2024-04-05 23:59:59',
                        'status' => 'IN_PROGRESS',
                        'assigned_to' => $availableMembers[1] ?? null,
                    ],
                    [
                        'project_id' => $project->id,
                        'title' => 'Frontend con React',
                        'description' => 'Desarrollar la interfaz de usuario utilizando React y consumir la API.',
                        'start_date' => '2024-04-06 09:00:00',
                        'due_date' => '2024-04-25 23:59:59',
                        'status' => 'PENDING',
                        'assigned_to' => $availableMembers[2] ?? null,
                    ],
                ]);
            }
            
            // Tareas para proyecto 2
            if ($project->id == 2) {
                $tasks = array_merge($tasks, [
                    [
                        'project_id' => $project->id,
                        'title' => 'Configuración del entorno',
                        'description' => 'Instalar y configurar Laravel, Vue.js y herramientas necesarias.',
                        'start_date' => '2024-03-15 09:00:00',
                        'due_date' => '2024-03-20 23:59:59',
                        'status' => 'COMPLETED',
                        'assigned_to' => $availableMembers[0] ?? null,
                    ],
                    [
                        'project_id' => $project->id,
                        'title' => 'Implementar catálogo de productos',
                        'description' => 'Crear CRUD de productos con imágenes y categorías.',
                        'start_date' => '2024-03-21 09:00:00',
                        'due_date' => '2024-04-15 23:59:59',
                        'status' => 'IN_PROGRESS',
                        'assigned_to' => $availableMembers[1] ?? null,
                    ],
                    [
                        'project_id' => $project->id,
                        'title' => 'Integrar pasarela de pagos',
                        'description' => 'Implementar Stripe o PayPal para procesar pagos.',
                        'start_date' => '2024-04-16 09:00:00',
                        'due_date' => '2024-05-10 23:59:59',
                        'status' => 'PENDING',
                        'assigned_to' => $availableMembers[2] ?? null,
                    ],
                ]);
            }
        }
        
        foreach ($tasks as $task) {
            Task::create($task);
        }
        
        // Crear tareas adicionales con factory
        if (env('APP_ENV') !== 'production') {
            Task::factory(50)->create();
        }
    }
}