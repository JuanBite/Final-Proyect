<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Vincular entrega a una tarea específica del cronograma
            $table->unsignedBigInteger('task_id')->nullable()->after('project_id');
            $table->foreign('task_id')->references('id')->on('project_tasks')->onDelete('set null');

            // Renombrar file_path a stored_path y agregar nombre original
            $table->string('original_filename', 255)->nullable()->after('file_path');
            $table->string('mime_type', 100)->nullable()->after('original_filename');

            // Semana a la que corresponde la entrega (1-4)
            $table->unsignedTinyInteger('week_number')->nullable()->after('mime_type');
            // Mes y año de la entrega para filtrado
            $table->unsignedSmallInteger('submission_month')->nullable()->after('week_number');
            $table->unsignedSmallInteger('submission_year')->nullable()->after('submission_month');
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropColumn(['task_id', 'original_filename', 'mime_type', 'week_number', 'submission_month', 'submission_year']);
        });
    }
};