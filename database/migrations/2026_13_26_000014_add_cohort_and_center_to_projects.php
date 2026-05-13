<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // La ficha (cohort) a la que pertenece el proyecto
            $table->foreignId('cohort_id')
                ->nullable()
                ->after('leader_id')
                ->constrained('cohorts')
                ->nullOnDelete();

            // Desnormalizado para queries rápidas de aislamiento por centro
            $table->foreignId('center_id')
                ->nullable()
                ->after('cohort_id')
                ->constrained('centers')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['cohort_id']);
            $table->dropForeign(['center_id']);
            $table->dropColumn(['cohort_id', 'center_id']);
        });
    }
};