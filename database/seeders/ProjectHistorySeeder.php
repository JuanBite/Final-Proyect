<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectHistory;

class ProjectHistorySeeder extends Seeder
{
    public function run(): void
    {
        // Historial para Proyecto 1
        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Proyecto creado';
        $history->performed_by = 3; // Carlos Rodríguez
        $history->created_at = '2024-03-01 09:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Líder asignado: Carlos Rodríguez';
        $history->performed_by = 3;
        $history->created_at = '2024-03-01 09:05:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Miembros agregados: Andrés Silva, Camila Torres, Felipe Reyes';
        $history->performed_by = 3;
        $history->created_at = '2024-03-01 10:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Tarea completada: Diseño de base de datos';
        $history->performed_by = 8; // Andrés Silva
        $history->created_at = '2024-03-14 15:30:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Progreso actualizado al 25%';
        $history->performed_by = 3;
        $history->created_at = '2024-03-15 11:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Entrega parcial realizada';
        $history->performed_by = 8;
        $history->created_at = '2024-04-20 15:30:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 1;
        $history->action = 'Progreso actualizado al 75%';
        $history->performed_by = 3;
        $history->created_at = '2024-04-21 10:00:00';
        $history->save();

        // Historial para Proyecto 3 (completado)
        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Proyecto creado';
        $history->performed_by = 5; // Luis Sánchez
        $history->created_at = '2024-02-01 09:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Líder asignado: Luis Sánchez';
        $history->performed_by = 5;
        $history->created_at = '2024-02-01 09:05:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Miembros agregados: Valentina Ortiz, Nicolás Flores';
        $history->performed_by = 5;
        $history->created_at = '2024-02-01 10:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Tarea completada: Diseño de API';
        $history->performed_by = 13; // Valentina Ortiz
        $history->created_at = '2024-02-14 16:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Tarea completada: Implementar autenticación JWT';
        $history->performed_by = 14; // Nicolás Flores
        $history->created_at = '2024-03-04 14:30:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Tarea completada: CRUD de pedidos';
        $history->performed_by = 13;
        $history->created_at = '2024-03-24 18:45:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Estado actualizado a COMPLETADO';
        $history->performed_by = 5;
        $history->created_at = '2024-03-31 10:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 3;
        $history->action = 'Entrega final evaluada con nota 85.5';
        $history->performed_by = 5;
        $history->created_at = '2024-04-01 09:00:00';
        $history->save();

        // Historial para Proyecto 5 (completado)
        $history = new ProjectHistory;
        $history->project_id = 5;
        $history->action = 'Proyecto creado';
        $history->performed_by = 6; // Patricia López
        $history->created_at = '2024-01-10 09:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 5;
        $history->action = 'Estado actualizado a COMPLETADO';
        $history->performed_by = 6;
        $history->created_at = '2024-04-09 18:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 5;
        $history->action = 'Entrega final evaluada con nota 92.0';
        $history->performed_by = 6;
        $history->created_at = '2024-04-10 11:00:00';
        $history->save();

        // Historial para Proyecto 6 (DELAYED)
        $history = new ProjectHistory;
        $history->project_id = 6;
        $history->action = 'Proyecto creado';
        $history->performed_by = 4; // Ana Martínez
        $history->created_at = '2024-03-25 09:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 6;
        $history->action = 'Estado actualizado a DELAYED';
        $history->performed_by = 4;
        $history->created_at = '2024-04-20 14:00:00';
        $history->save();

        $history = new ProjectHistory;
        $history->project_id = 6;
        $history->action = 'Progreso actualizado al 15% - Retraso en desarrollo';
        $history->performed_by = 4;
        $history->created_at = '2024-04-20 14:05:00';
        $history->save();
    }
}