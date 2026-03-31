<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'Región Metropolitana', 'code' => 'RM'],
            ['name' => 'Región de Valparaíso', 'code' => 'VAL'],
            ['name' => 'Región del Biobío', 'code' => 'BIO'],
            ['name' => 'Región de la Araucanía', 'code' => 'ARA'],
            ['name' => 'Región de Los Lagos', 'code' => 'LAG'],
            ['name' => 'Región de Antofagasta', 'code' => 'ANT'],
            ['name' => 'Región de Coquimbo', 'code' => 'COQ'],
            ['name' => 'Región de O\'Higgins', 'code' => 'OHI'],
            ['name' => 'Región del Maule', 'code' => 'MAU'],
            ['name' => 'Región de Arica y Parinacota', 'code' => 'ARI'],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}