<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('code',20)->nullable();

            $table->foreignId('regional_id')
                ->constrained('regional')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};