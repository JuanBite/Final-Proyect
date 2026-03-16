<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();

            $table->string('ficha_number',20)->unique();
            $table->string('program_name',150)->nullable();

            $table->foreignId('centro_id')
                ->constrained('centros')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};