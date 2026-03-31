<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Tareas para Proyecto 1: Sistema de Gestión de Tareas
        $task = new Task;
        $task->project_id = 1;
        $task->title = 'Diseño de base de datos';
        $task->description = 'Crear el modelo entidad-relación y normalizar la base de datos.';
        $task->start_date = '2024-03-01 09:00:00';
        $task->due_date = '2024-03-15 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 8; // Andrés Silva
        $task->save();

        $task = new Task;
        $task->project_id = 1;
        $task->title = 'Desarrollo del backend con Laravel';
        $task->description = 'Implementar API REST con autenticación y CRUD de tareas.';
        $task->start_date = '2024-03-16 09:00:00';
        $task->due_date = '2024-04-05 23:59:59';
        $task->status = 'IN_PROGRESS';
        $task->assigned_to = 9; // Camila Torres
        $task->save();

        $task = new Task;
        $task->project_id = 1;
        $task->title = 'Frontend con React';
        $task->description = 'Desarrollar la interfaz de usuario utilizando React y consumir la API.';
        $task->start_date = '2024-04-06 09:00:00';
        $task->due_date = '2024-04-25 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 10; // Felipe Reyes
        $task->save();

        $task = new Task;
        $task->project_id = 1;
        $task->title = 'Pruebas y documentación';
        $task->description = 'Realizar pruebas unitarias y de integración, y documentar el proyecto.';
        $task->start_date = '2024-04-26 09:00:00';
        $task->due_date = '2024-04-30 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 8; // Andrés Silva
        $task->save();

        // Tareas para Proyecto 2: E-commerce de Productos Digitales
        $task = new Task;
        $task->project_id = 2;
        $task->title = 'Configuración del entorno';
        $task->description = 'Instalar y configurar Laravel, Vue.js y herramientas necesarias.';
        $task->start_date = '2024-03-15 09:00:00';
        $task->due_date = '2024-03-20 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 11; // Daniela Castro
        $task->save();

        $task = new Task;
        $task->project_id = 2;
        $task->title = 'Implementar catálogo de productos';
        $task->description = 'Crear CRUD de productos con imágenes y categorías.';
        $task->start_date = '2024-03-21 09:00:00';
        $task->due_date = '2024-04-15 23:59:59';
        $task->status = 'IN_PROGRESS';
        $task->assigned_to = 12; // Sebastián Morales
        $task->save();

        $task = new Task;
        $task->project_id = 2;
        $task->title = 'Carrito de compras';
        $task->description = 'Implementar funcionalidad de carrito de compras con sesiones.';
        $task->start_date = '2024-04-16 09:00:00';
        $task->due_date = '2024-05-05 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 11; // Daniela Castro
        $task->save();

        $task = new Task;
        $task->project_id = 2;
        $task->title = 'Integrar pasarela de pagos';
        $task->description = 'Implementar Stripe o PayPal para procesar pagos.';
        $task->start_date = '2024-05-06 09:00:00';
        $task->due_date = '2024-05-15 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 12; // Sebastián Morales
        $task->save();

        // Tareas para Proyecto 3: API REST para Aplicación Móvil
        $task = new Task;
        $task->project_id = 3;
        $task->title = 'Diseño de API';
        $task->description = 'Definir endpoints, autenticación y estructura de respuestas.';
        $task->start_date = '2024-02-01 09:00:00';
        $task->due_date = '2024-02-15 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 13; // Valentina Ortiz
        $task->save();

        $task = new Task;
        $task->project_id = 3;
        $task->title = 'Implementar autenticación JWT';
        $task->description = 'Crear sistema de registro, login y manejo de tokens.';
        $task->start_date = '2024-02-16 09:00:00';
        $task->due_date = '2024-03-05 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 14; // Nicolás Flores
        $task->save();

        $task = new Task;
        $task->project_id = 3;
        $task->title = 'CRUD de pedidos';
        $task->description = 'Implementar endpoints para gestión de pedidos y delivery.';
        $task->start_date = '2024-03-06 09:00:00';
        $task->due_date = '2024-03-25 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 13; // Valentina Ortiz
        $task->save();

        $task = new Task;
        $task->project_id = 3;
        $task->title = 'Documentación de API';
        $task->description = 'Crear documentación con Swagger/OpenAPI.';
        $task->start_date = '2024-03-26 09:00:00';
        $task->due_date = '2024-03-31 23:59:59';
        $task->status = 'COMPLETED';
        $task->assigned_to = 14; // Nicolás Flores
        $task->save();

        // Tareas para Proyecto 4: Dashboard de Análisis de Datos
        $task = new Task;
        $task->project_id = 4;
        $task->title = 'Configuración de base de datos';
        $task->description = 'Preparar base de datos con datos de ejemplo para análisis.';
        $task->start_date = '2024-03-20 09:00:00';
        $task->due_date = '2024-04-05 23:59:59';
        $task->status = 'IN_PROGRESS';
        $task->assigned_to = 8; // Andrés Silva
        $task->save();

        $task = new Task;
        $task->project_id = 4;
        $task->title = 'Implementar gráficos con Chart.js';
        $task->description = 'Crear visualizaciones de datos interactivas.';
        $task->start_date = '2024-04-06 09:00:00';
        $task->due_date = '2024-04-25 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 9; // Camila Torres
        $task->save();

        $task = new Task;
        $task->project_id = 4;
        $task->title = 'Filtros y exportación de datos';
        $task->description = 'Implementar filtros por fecha y exportación a Excel/PDF.';
        $task->start_date = '2024-04-26 09:00:00';
        $task->due_date = '2024-05-20 23:59:59';
        $task->status = 'PENDING';
        $task->assigned_to = 10; // Felipe Reyes
        $task->save();
    }
}