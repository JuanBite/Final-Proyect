<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden de dependencias
        $this->call([
            RegionSeeder::class,
            CenterSeeder::class,
            CohortSeeder::class,
            UserSeeder::class,
            ProjectSeeder::class,
            ProjectMemberSeeder::class,
            TaskSeeder::class,
            SubmissionSeeder::class,
            ProjectHistorySeeder::class,
        ]);
    }
}