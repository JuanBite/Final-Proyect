<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Region;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    public function run(): void
    {
        $centers = [
            ['name' => 'Centro de Formación Santiago', 'code' => 'CFS001', 'region_id' => 1],
            ['name' => 'Centro Tecnológico Valparaíso', 'code' => 'CTV002', 'region_id' => 2],
            ['name' => 'Centro de Innovación Concepción', 'code' => 'CIC003', 'region_id' => 3],
            ['name' => 'Centro de Capacitación Temuco', 'code' => 'CCT004', 'region_id' => 4],
            ['name' => 'Centro de Desarrollo Puerto Montt', 'code' => 'CDP005', 'region_id' => 5],
            ['name' => 'Centro de Excelencia Antofagasta', 'code' => 'CEA006', 'region_id' => 6],
            ['name' => 'Centro de Formación La Serena', 'code' => 'CFL007', 'region_id' => 7],
            ['name' => 'Centro de Capacitación Rancagua', 'code' => 'CCR008', 'region_id' => 8],
            ['name' => 'Centro de Innovación Talca', 'code' => 'CIT009', 'region_id' => 9],
            ['name' => 'Centro Tecnológico Arica', 'code' => 'CTA010', 'region_id' => 10],
        ];

        foreach ($centers as $center) {
            Center::create($center);
        }
        
        // Crear centros adicionales con factory si se necesitan más
        if (env('APP_ENV') !== 'production') {
            Center::factory(5)->create();
        }
    }
}   