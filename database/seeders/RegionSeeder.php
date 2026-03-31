<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use Carbon\Carbon;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $region = new Region;
        $region->name = 'Región Metropolitana';
        $region->code = 'RM';
        $region->save();

        $region = new Region;
        $region->name = 'Región de Valparaíso';
        $region->code = 'VAL';
        $region->save();

        $region = new Region;
        $region->name = 'Región del Biobío';
        $region->code = 'BIO';
        $region->save();

        $region = new Region;
        $region->name = 'Región de la Araucanía';
        $region->code = 'ARA';
        $region->save();

        $region = new Region;
        $region->name = 'Región de Los Lagos';
        $region->code = 'LAG';
        $region->save();

        $region = new Region;
        $region->name = 'Región de Antofagasta';
        $region->code = 'ANT';
        $region->save();

        $region = new Region;
        $region->name = 'Región de Coquimbo';
        $region->code = 'COQ';
        $region->save();

        $region = new Region;
        $region->name = 'Región de O\'Higgins';
        $region->code = 'OHI';
        $region->save();

        $region = new Region;
        $region->name = 'Región del Maule';
        $region->code = 'MAU';
        $region->save();

        $region = new Region;
        $region->name = 'Región de Arica y Parinacota';
        $region->code = 'ARI';
        $region->save();
    }
}   