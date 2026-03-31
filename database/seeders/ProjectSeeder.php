<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $project = new Project;
        $project->name = 'Sistema de Gestión de Tareas';
        $project->description = 'Desarrollar una aplicación web para gestión de tareas personales con autenticación y almacenamiento en base de datos.';
        $project->start_date = Carbon::parse('2024-03-01 09:00:00');
        $project->due_date = Carbon::parse('2024-04-30 23:59:59');
        $project->progress = 75.50;
        $project->leader_id = 3;
        $project->status = 'IN_PROGRESS';
        $project->save();

        $project = new Project;
        $project->name = 'E-commerce de Productos Digitales';
        $project->description = 'Crear una plataforma de comercio electrónico para la venta de productos digitales con pasarela de pagos.';
        $project->start_date = Carbon::parse('2024-03-15 09:00:00');
        $project->due_date = Carbon::parse('2024-05-15 23:59:59');
        $project->progress = 45.00;
        $project->leader_id = 4;
        $project->status = 'IN_PROGRESS';
        $project->save();

        $project = new Project;
        $project->name = 'API REST para Aplicación Móvil';
        $project->description = 'Desarrollar una API RESTful para una aplicación móvil de delivery con autenticación JWT.';
        $project->start_date = Carbon::parse('2024-02-01 09:00:00');
        $project->due_date = Carbon::parse('2024-03-31 23:59:59');
        $project->progress = 100.00;
        $project->leader_id = 5;
        $project->status = 'COMPLETED';
        $project->save();

        $project = new Project;
        $project->name = 'Dashboard de Análisis de Datos';
        $project->description = 'Crear un dashboard interactivo para visualización de datos de ventas con gráficos y filtros.';
        $project->start_date = Carbon::parse('2024-03-20 09:00:00');
        $project->due_date = Carbon::parse('2024-05-20 23:59:59');
        $project->progress = 30.00;
        $project->leader_id = 3;
        $project->status = 'IN_PROGRESS';
        $project->save();

        $project = new Project;
        $project->name = 'Sistema de Reservas Online';
        $project->description = 'Desarrollar un sistema de reservas para un hotel con calendario interactivo y gestión de habitaciones.';
        $project->start_date = Carbon::parse('2024-01-10 09:00:00');
        $project->due_date = Carbon::parse('2024-04-10 23:59:59');
        $project->progress = 100.00;
        $project->leader_id = 6;
        $project->status = 'COMPLETED';
        $project->save();

        $project = new Project;
        $project->name = 'Aplicación de Blog con Laravel';
        $project->description = 'Crear un blog completo con sistema de comentarios, categorías y administración de usuarios.';
        $project->start_date = Carbon::parse('2024-03-25 09:00:00');
        $project->due_date = Carbon::parse('2024-06-25 23:59:59');
        $project->progress = 15.00;
        $project->leader_id = 4;
        $project->status = 'DELAYED';
        $project->save();

        $project = new Project;
        $project->name = 'Plataforma de Cursos Online';
        $project->description = 'Desarrollar una plataforma LMS para la gestión de cursos, lecciones y evaluaciones.';
        $project->start_date = Carbon::parse('2024-04-01 09:00:00');
        $project->due_date = Carbon::parse('2024-07-01 23:59:59');
        $project->progress = 10.00;
        $project->leader_id = 7;
        $project->status = 'IN_PROGRESS';
        $project->save();

        $project = new Project;
        $project->name = 'Sistema de Inventario';
        $project->description = 'Crear un sistema para gestión de inventario con control de stock, proveedores y reportes.';
        $project->start_date = Carbon::parse('2024-03-10 09:00:00');
        $project->due_date = Carbon::parse('2024-05-10 23:59:59');
        $project->progress = 60.00;
        $project->leader_id = 5;
        $project->status = 'IN_PROGRESS';
        $project->save();
    }
}