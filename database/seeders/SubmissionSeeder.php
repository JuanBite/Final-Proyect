<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submission;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        // Entrega para Proyecto 1
        $submission = new Submission;
        $submission->project_id = 1;
        $submission->file_path = 'projects/project_1_submission_v1.zip';
        $submission->comments = 'Entrega parcial, el backend está funcionando pero falta el frontend.';
        $submission->submitted_at = '2024-04-20 15:30:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();

        // Entrega para Proyecto 2
        $submission = new Submission;
        $submission->project_id = 2;
        $submission->file_path = 'projects/project_2_submission_v1.zip';
        $submission->comments = 'Entrega de avance, catálogo de productos completado.';
        $submission->submitted_at = '2024-04-25 10:15:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();

        // Entrega para Proyecto 3 (completado)
        $submission = new Submission;
        $submission->project_id = 3;
        $submission->file_path = 'projects/project_3_final_submission.zip';
        $submission->comments = 'Entrega final completa con todas las funcionalidades solicitadas.';
        $submission->submitted_at = '2024-03-30 23:45:00';
        $submission->grade = 85.50;
        $submission->feedback = 'Excelente trabajo! La API funciona correctamente y la documentación es clara. Se recomienda mejorar los mensajes de error.';
        $submission->save();

        // Entrega para Proyecto 4
        $submission = new Submission;
        $submission->project_id = 4;
        $submission->file_path = 'projects/project_4_submission_v1.zip';
        $submission->comments = 'Entrega de avance, base de datos configurada.';
        $submission->submitted_at = '2024-04-10 14:20:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();

        // Entrega para Proyecto 5 (completado)
        $submission = new Submission;
        $submission->project_id = 5;
        $submission->file_path = 'projects/project_5_final_submission.zip';
        $submission->comments = 'Entrega final con sistema de reservas completamente funcional.';
        $submission->submitted_at = '2024-04-09 18:00:00';
        $submission->grade = 92.00;
        $submission->feedback = 'Excelente implementación! El calendario interactivo funciona perfectamente y la interfaz es muy intuitiva.';
        $submission->save();

        // Entrega para Proyecto 6
        $submission = new Submission;
        $submission->project_id = 6;
        $submission->file_path = 'projects/project_6_submission_v1.zip';
        $submission->comments = 'Entrega inicial, estructura básica del blog creada.';
        $submission->submitted_at = '2024-04-15 11:00:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();

        // Entrega para Proyecto 7
        $submission = new Submission;
        $submission->project_id = 7;
        $submission->file_path = 'projects/project_7_submission_v1.zip';
        $submission->comments = 'Entrega de avance, estructura de base de datos definida.';
        $submission->submitted_at = '2024-04-18 09:30:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();

        // Entrega para Proyecto 8
        $submission = new Submission;
        $submission->project_id = 8;
        $submission->file_path = 'projects/project_8_submission_v1.zip';
        $submission->comments = 'Entrega de avance, CRUD de inventario completado.';
        $submission->submitted_at = '2024-04-12 16:45:00';
        $submission->grade = null;
        $submission->feedback = null;
        $submission->save();
    }
}