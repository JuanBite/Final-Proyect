<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectHistorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_history')->insert([
            // Proyecto 1
            [
                'project_id' => 1,
                'action' => 'Proyecto creado',
                'performed_by' => 3,
                'created_at' => '2024-03-01 09:00:00',
            ],
            [
                'project_id' => 1,
                'action' => 'Líder asignado: Carlos Rodríguez',
                'performed_by' => 3,
                'created_at' => '2024-03-01 09:05:00',
            ],
            [
                'project_id' => 1,
                'action' => 'Tarea completada: Diseño de base de datos',
                'performed_by' => 8,
                'created_at' => '2024-03-14 15:30:00',
            ],
            [
                'project_id' => 1,
                'action' => 'Progreso actualizado al 75%',
                'performed_by' => 3,
                'created_at' => '2024-04-21 10:00:00',
            ],
            // Proyecto 3 (completado)
            [
                'project_id' => 3,
                'action' => 'Proyecto creado',
                'performed_by' => 5,
                'created_at' => '2024-02-01 09:00:00',
            ],
            [
                'project_id' => 3,
                'action' => 'Estado actualizado a COMPLETADO',
                'performed_by' => 5,
                'created_at' => '2024-03-31 10:00:00',
            ],
            [
                'project_id' => 3,
                'action' => 'Entrega final evaluada con nota 85.5',
                'performed_by' => 5,
                'created_at' => '2024-04-01 09:00:00',
            ],
            // Proyecto 6 (DELAYED)
            [
                'project_id' => 6,
                'action' => 'Proyecto creado',
                'performed_by' => 4,
                'created_at' => '2024-03-25 09:00:00',
            ],
            [
                'project_id' => 6,
                'action' => 'Estado actualizado a DELAYED',
                'performed_by' => 4,
                'created_at' => '2024-04-20 14:00:00',
            ],
        ]);
        
        $this->command->info('Historial insertado: ' . DB::table('project_history')->count());
    }
}