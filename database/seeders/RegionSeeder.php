<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $region = new Region;
        $region->name = 'Amazonas';
        $region->code = 'AMA';
        $region->save();

        $region = new Region;
        $region->name = 'Antioquia';
        $region->code = 'ANT';
        $region->save();

        $region = new Region;
        $region->name = 'Arauca';
        $region->code = 'ARA';
        $region->save();

        $region = new Region;
        $region->name = 'Atlántico';
        $region->code = 'ATL';
        $region->save();

        $region = new Region;
        $region->name = 'Bolívar';
        $region->code = 'BOL';
        $region->save();

        $region = new Region;
        $region->name = 'Boyacá';
        $region->code = 'BOY';
        $region->save();

        $region = new Region;
        $region->name = 'Caldas';
        $region->code = 'CAL';
        $region->save();

        $region = new Region;
        $region->name = 'Caquetá';
        $region->code = 'CAQ';
        $region->save();

        $region = new Region;
        $region->name = 'Casanare';
        $region->code = 'CAS';
        $region->save();

        $region = new Region;
        $region->name = 'Cauca';
        $region->code = 'CAU';
        $region->save();

        $region = new Region;
        $region->name = 'Cesar';
        $region->code = 'CES';
        $region->save();

        $region = new Region;
        $region->name = 'Chocó';
        $region->code = 'CHO';
        $region->save();

        $region = new Region;
        $region->name = 'Córdoba';
        $region->code = 'COR';
        $region->save();

        $region = new Region;
        $region->name = 'Cundinamarca';
        $region->code = 'CUN';
        $region->save();

        $region = new Region;
        $region->name = 'Distrito Capital';
        $region->code = 'DC';
        $region->save();

        $region = new Region;
        $region->name = 'Guainía';
        $region->code = 'GUA';
        $region->save();

        $region = new Region;
        $region->name = 'Guaviare';
        $region->code = 'GUV';
        $region->save();

        $region = new Region;
        $region->name = 'Huila';
        $region->code = 'HUI';
        $region->save();

        $region = new Region;
        $region->name = 'La Guajira';
        $region->code = 'LAG';
        $region->save();

        $region = new Region;
        $region->name = 'Magdalena';
        $region->code = 'MAG';
        $region->save();

        $region = new Region;
        $region->name = 'Meta';
        $region->code = 'MET';
        $region->save();

        $region = new Region;
        $region->name = 'Nariño';
        $region->code = 'NAR';
        $region->save();

        $region = new Region;
        $region->name = 'Norte de Santander';
        $region->code = 'NSA';
        $region->save();

        $region = new Region;
        $region->name = 'Putumayo';
        $region->code = 'PUT';
        $region->save();

        $region = new Region;
        $region->name = 'Quindío';
        $region->code = 'QUI';
        $region->save();

        $region = new Region;
        $region->name = 'Risaralda';
        $region->code = 'RIS';
        $region->save();

        $region = new Region;
        $region->name = 'San Andrés';
        $region->code = 'SAN';
        $region->save();

        $region = new Region;
        $region->name = 'Santander';
        $region->code = 'SANTR';
        $region->save();

        $region = new Region;
        $region->name = 'Sucre';
        $region->code = 'SUC';
        $region->save();

        $region = new Region;
        $region->name = 'Tolima';
        $region->code = 'TOL';
        $region->save();

        $region = new Region;
        $region->name = 'Valle del Cauca';
        $region->code = 'VAL';
        $region->save();

        $region = new Region;
        $region->name = 'Vaupés';
        $region->code = 'VAU';
        $region->save();

        $region = new Region;
        $region->name = 'Vichada';
        $region->code = 'VIC';
        $region->save();
    }
}