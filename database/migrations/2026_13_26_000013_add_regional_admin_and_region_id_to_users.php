<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL requiere ALTER directo para cambiar ENUM
        DB::statement("
            ALTER TABLE users 
            MODIFY COLUMN role 
            ENUM('ADMIN','REGIONAL_ADMIN','COORDINATOR','INSTRUCTOR','STUDENT') 
            NOT NULL
        ");

        Schema::table('users', function (Blueprint $table) {
            // Los REGIONAL_ADMIN se vinculan a una regional
            $table->foreignId('region_id')
                ->nullable()
                ->after('center_id')
                ->constrained('region')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
        });

        DB::statement("
            ALTER TABLE users 
            MODIFY COLUMN role 
            ENUM('ADMIN','COORDINATOR','INSTRUCTOR','STUDENT') 
            NOT NULL
        ");
    }
};