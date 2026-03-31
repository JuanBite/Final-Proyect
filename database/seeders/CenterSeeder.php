<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Center;

class CenterSeeder extends Seeder
{
    public function run(): void
    {
        $center = new Center;
        $center->name = 'Centro de Formación Santiago';
        $center->code = 'CFS001';
        $center->region_id = 1;
        $center->save();

        $center = new Center;
        $center->name = 'Centro Tecnológico Valparaíso';
        $center->code = 'CTV002';
        $center->region_id = 2;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Innovación Concepción';
        $center->code = 'CIC003';
        $center->region_id = 3;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Capacitación Temuco';
        $center->code = 'CCT004';
        $center->region_id = 4;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Desarrollo Puerto Montt';
        $center->code = 'CDP005';
        $center->region_id = 5;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Excelencia Antofagasta';
        $center->code = 'CEA006';
        $center->region_id = 6;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Formación La Serena';
        $center->code = 'CFL007';
        $center->region_id = 7;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Capacitación Rancagua';
        $center->code = 'CCR008';
        $center->region_id = 8;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Innovación Talca';
        $center->code = 'CIT009';
        $center->region_id = 9;
        $center->save();

        $center = new Center;
        $center->name = 'Centro Tecnológico Arica';
        $center->code = 'CTA010';
        $center->region_id = 10;
        $center->save();
    }
}