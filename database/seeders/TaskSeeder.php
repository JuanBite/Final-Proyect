<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            // Proyecto 1
            [
                'project_id' => 1,
                'title' => 'Diseño de base de datos',
                'description' => 'Crear el modelo entidad-relación.',
                'start_date' => '2024-03-01 09:00:00',
                'due_date' => '2024-03-15 23:59:59',
                'status' => 'COMPLETED',
                'assigned_to' => 8,
            ],
            [
                'project_id' => 1,
                'title' => 'Backend con Laravel',
                'description' => 'API REST',
                'start_date' => '2024-03-16 09:00:00',
                'due_date' => '2024-04-05 23:59:59',
                'status' => 'IN_PROGRESS',
                'assigned_to' => 9,
            ],

            // Proyecto 2
            [
                'project_id' => 2,
                'title' => 'Configuración entorno',
                'description' => 'Instalar herramientas',
                'start_date' => '2024-03-15',
                'due_date' => '2024-03-20',
                'status' => 'COMPLETED',
                'assigned_to' => 11, // ❌ puede no existir
            ],
        ];

        foreach ($tasks as $item) {

            $user = User::find($item['assigned_to']);
            $project = Project::find($item['project_id']);

            // 🔥 VALIDACIÓN CLAVE
            if ($user && $project) {
                Task::create([
                    'project_id' => $project->id,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'start_date' => $item['start_date'],
                    'due_date' => $item['due_date'],
                    'status' => $item['status'],
                    'assigned_to' => $user->id,
                ]);
            }
        }
    }
}