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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->string('file_path')->nullable();
            $table->text('comments')->nullable();
            $table->dateTime('submitted_at')->useCurrent();

            $table->decimal('grade', 4, 2)->nullable();
            $table->text('feedback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
