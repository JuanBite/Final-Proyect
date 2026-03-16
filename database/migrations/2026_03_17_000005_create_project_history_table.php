<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('project_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->string('action');

            $table->foreignId('performed_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_history');
    }
};
