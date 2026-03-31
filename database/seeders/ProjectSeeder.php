<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::where('role', 'INSTRUCTOR')->get();
        
        $projects = [
            [
                'name' => 'Sistema de Gestión de Tareas',
                'description' => 'Desarrollar una aplicación web para gestión de tareas personales con autenticación y almacenamiento en base de datos.',
                'start_date' => '2024-03-01 09:00:00',
                'due_date' => '2024-04-30 23:59:59',
                'progress' => 75.50,
                'leader_id' => $instructors[0]->id ?? 1,
                'status' => 'IN_PROGRESS',
            ],
            [
                'name' => 'E-commerce de Productos Digitales',
                'description' => 'Crear una plataforma de comercio electrónico para la venta de productos digitales con pasarela de pagos.',
                'start_date' => '2024-03-15 09:00:00',
                'due_date' => '2024-05-15 23:59:59',
                'progress' => 45.00,
                'leader_id' => $instructors[1]->id ?? 2,
                'status' => 'IN_PROGRESS',
            ],
            [
                'name' => 'API REST para Aplicación Móvil',
                'description' => 'Desarrollar una API RESTful para una aplicación móvil de delivery con autenticación JWT.',
                'start_date' => '2024-02-01 09:00:00',
                'due_date' => '2024-03-31 23:59:59',
                'progress' => 100.00,
                'leader_id' => $instructors[2]->id ?? 3,
                'status' => 'COMPLETED',
            ],
            [
                'name' => 'Dashboard de Análisis de Datos',
                'description' => 'Crear un dashboard interactivo para visualización de datos de ventas con gráficos y filtros.',
                'start_date' => '2024-03-20 09:00:00',
                'due_date' => '2024-05-20 23:59:59',
                'progress' => 30.00,
                'leader_id' => $instructors[0]->id ?? 1,
                'status' => 'IN_PROGRESS',
            ],
            [
                'name' => 'Sistema de Reservas Online',
                'description' => 'Desarrollar un sistema de reservas para un hotel con calendario interactivo y gestión de habitaciones.',
                'start_date' => '2024-01-10 09:00:00',
                'due_date' => '2024-04-10 23:59:59',
                'progress' => 100.00,
                'leader_id' => $instructors[3]->id ?? 4,
                'status' => 'COMPLETED',
            ],
            [
                'name' => 'Aplicación de Blog con Laravel',
                'description' => 'Crear un blog completo con sistema de comentarios, categorías y administración de usuarios.',
                'start_date' => '2024-03-25 09:00:00',
                'due_date' => '2024-06-25 23:59:59',
                'progress' => 15.00,
                'leader_id' => $instructors[1]->id ?? 2,
                'status' => 'DELAYED',
            ],
            [
                'name' => 'Plataforma de Cursos Online',
                'description' => 'Desarrollar una plataforma LMS para la gestión de cursos, lecciones y evaluaciones.',
                'start_date' => '2024-04-01 09:00:00',
                'due_date' => '2024-07-01 23:59:59',
                'progress' => 10.00,
                'leader_id' => $instructors[4]->id ?? 5,
                'status' => 'IN_PROGRESS',
            ],
            [
                'name' => 'Sistema de Inventario',
                'description' => 'Crear un sistema para gestión de inventario con control de stock, proveedores y reportes.',
                'start_date' => '2024-03-10 09:00:00',
                'due_date' => '2024-05-10 23:59:59',
                'progress' => 60.00,
                'leader_id' => $instructors[2]->id ?? 3,
                'status' => 'IN_PROGRESS',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
        
        // Crear proyectos adicionales con factory
        if (env('APP_ENV') !== 'production') {
            Project::factory(12)->create();
        }
    }
}