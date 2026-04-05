<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Center;

class CenterSeeder extends Seeder
{
    public function run(): void
    {

        // ANTIOQUIA (region_id = 2)

        $center = new Center;
        $center->name = 'Centro de Servicios y Gestión Empresarial';
        $center->code = 'ANT001';
        $center->region_id = 2;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Tecnología de la Manufactura Avanzada';
        $center->code = 'ANT002';
        $center->region_id = 2;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Comercio';
        $center->code = 'ANT003';
        $center->region_id = 2;
        $center->save();


        // VALLE DEL CAUCA (region_id = 31)

        $center = new Center;
        $center->name = 'Centro de Electricidad y Automatización Industrial';
        $center->code = 'VAL001';
        $center->region_id = 31;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Gestión Tecnológica de Servicios';
        $center->code = 'VAL002';
        $center->region_id = 31;
        $center->save();

        $center = new Center;
        $center->name = 'Centro Nacional de Asistencia Técnica a la Industria';
        $center->code = 'VAL003';
        $center->region_id = 31;
        $center->save();


        // BOGOTÁ (region_id = 15)

        $center = new Center;
        $center->name = 'Centro de Gestión Administrativa';
        $center->code = 'DC001';
        $center->region_id = 15;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Electricidad, Electrónica y Telecomunicaciones';
        $center->code = 'DC002';
        $center->region_id = 15;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Diseño y Metrología';
        $center->code = 'DC003';
        $center->region_id = 15;
        $center->save();


        // ATLÁNTICO (region_id = 4)

        $center = new Center;
        $center->name = 'Centro Industrial y de Aviación';
        $center->code = 'ATL001';
        $center->region_id = 4;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Comercio y Servicios';
        $center->code = 'ATL002';
        $center->region_id = 4;
        $center->save();


        // SANTANDER (region_id = 28)

        $center = new Center;
        $center->name = 'Centro Industrial del Diseño y la Manufactura';
        $center->code = 'SAN001';
        $center->region_id = 28;
        $center->save();

        $center = new Center;
        $center->name = 'Centro de Servicios Empresariales y Turísticos';
        $center->code = 'SAN002';
        $center->region_id = 28;
        $center->save();


        // META (region_id = 21)

        $center = new Center;
        $center->name = 'Centro Agroindustrial del Meta';
        $center->code = 'MET001';
        $center->region_id = 21;
        $center->save();


        // HUILA (region_id = 18)

        $center = new Center;
        $center->name = 'Centro de la Industria, la Empresa y los Servicios';
        $center->code = 'HUI001';
        $center->region_id = 18;
        $center->save();


        // NARIÑO (region_id = 22)

        $center = new Center;
        $center->name = 'Centro Sur Colombiano de Logística Internacional';
        $center->code = 'NAR001';
        $center->region_id = 22;
        $center->save();


        // CUNDINAMARCA (region_id = 14)

        $center = new Center;
        $center->name = 'Centro de Biotecnología Agropecuaria';
        $center->code = 'CUN001';
        $center->region_id = 14;
        $center->save();

    }
}