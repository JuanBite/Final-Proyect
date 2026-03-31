<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios ADMIN
        $user = new User;
        $user->first_name = 'Juan';
        $user->last_name = 'Pérez';
        $user->email = 'admin@sigpro.com';
        $user->password = Hash::make('admin123');
        $user->role = 'ADMIN';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'María';
        $user->last_name = 'González';
        $user->email = 'superadmin@sigpro.com';
        $user->password = Hash::make('admin123');
        $user->role = 'ADMIN';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        // Usuarios INSTRUCTOR
        $instructors = [
            ['Carlos', 'Rodríguez', 'carlos.rodriguez@sigpro.com'],
            ['Ana', 'Martínez', 'ana.martinez@sigpro.com'],
            ['Luis', 'Sánchez', 'luis.sanchez@sigpro.com'],
            ['Patricia', 'López', 'patricia.lopez@sigpro.com'],
            ['Roberto', 'Fernández', 'roberto.fernandez@sigpro.com'],
        ];

        foreach ($instructors as $instructor) {
            $user = new User;
            $user->first_name = $instructor[0];
            $user->last_name = $instructor[1];
            $user->email = $instructor[2];
            $user->password = Hash::make('instructor123');
            $user->role = 'INSTRUCTOR';
            $user->status = 1;
            $user->cohort_id = null;
            $user->save();
        }

        // Usuarios STUDENT
        $students = [
            ['Andrés', 'Silva', 'andres.silva@student.com', 1],
            ['Camila', 'Torres', 'camila.torres@student.com', 1],
            ['Felipe', 'Reyes', 'felipe.reyes@student.com', 1],
            ['Daniela', 'Castro', 'daniela.castro@student.com', 2],
            ['Sebastián', 'Morales', 'sebastian.morales@student.com', 2],
            ['Valentina', 'Ortiz', 'valentina.ortiz@student.com', 3],
            ['Nicolás', 'Flores', 'nicolas.flores@student.com', 3],
            ['Francisca', 'Navarro', 'francisca.navarro@student.com', 4],
            ['Cristóbal', 'Rojas', 'cristobal.rojas@student.com', 4],
            ['Isidora', 'Contreras', 'isidora.contreras@student.com', 5],
        ];

        foreach ($students as $student) {
            $user = new User;
            $user->first_name = $student[0];
            $user->last_name = $student[1];
            $user->email = $student[2];
            $user->password = Hash::make('student123');
            $user->role = 'STUDENT';
            $user->status = 1;
            $user->cohort_id = $student[3];
            $user->save();
        }
    }
}