<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            CenterSeeder::class,
            CohortSeeder::class,
            UserSeeder::class,
            ProjectSeeder::class,
            ProjectMemberSeeder::class,
        ]);
    }
}