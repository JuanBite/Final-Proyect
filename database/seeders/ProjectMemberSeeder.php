<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectMember;

class ProjectMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Proyecto 1: Sistema de Gestión de Tareas
        $member = new ProjectMember;
        $member->project_id = 1;
        $member->user_id = 3; // Carlos Rodríguez (líder)
        $member->project_role = 'LEADER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 1;
        $member->user_id = 8; // Andrés Silva
        $member->project_role = 'MEMBER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 1;
        $member->user_id = 9; // Camila Torres
        $member->project_role = 'MEMBER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 1;
        $member->user_id = 10; // Felipe Reyes
        $member->project_role = 'MEMBER';
        $member->save();

        // Proyecto 2: E-commerce de Productos Digitales
        $member = new ProjectMember;
        $member->project_id = 2;
        $member->user_id = 4; // Ana Martínez (líder)
        $member->project_role = 'LEADER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 2;
        $member->user_id = 11; // Daniela Castro
        $member->project_role = 'MEMBER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 2;
        $member->user_id = 12; // Sebastián Morales
        $member->project_role = 'MEMBER';
        $member->save();

        // Proyecto 3: API REST para Aplicación Móvil
        $member = new ProjectMember;
        $member->project_id = 3;
        $member->user_id = 5; // Luis Sánchez (líder)
        $member->project_role = 'LEADER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 3;
        $member->user_id = 13; // Valentina Ortiz
        $member->project_role = 'MEMBER';
        $member->save();

        $member = new ProjectMember;
        $member->project_id = 3;
        $member->user_id = 14; // Nicolás Flores
        $member->project_role = 'MEMBER';
        $member->save();
    }
}