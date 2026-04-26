<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('tasks', 'project_tasks');

        Schema::table('project_tasks', function (Blueprint $table) {
            // Agregar campo de fase (ej: "INVESTIGACIÓN", "CONSTRUCCIÓN DEL SOFTWARE")
            $table->string('phase', 100)->nullable()->after('project_id');
            // Agregar orden dentro de la fase
            $table->unsignedInteger('sort_order')->default(0)->after('phase');
        });
    }

    public function down(): void
    {
        Schema::table('project_tasks', function (Blueprint $table) {
            $table->dropColumn(['phase', 'sort_order']);
        });

        Schema::rename('project_tasks', 'tasks');
    }
};