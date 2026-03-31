<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cohort;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios ADMIN
        $admins = [
            [
                'first_name' => 'Juan',
                'last_name' => 'Pérez',
                'email' => 'admin@sigpro.com',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
                'status' => 1,
                'cohort_id' => null,
            ],
            [
                'first_name' => 'María',
                'last_name' => 'González',
                'email' => 'superadmin@sigpro.com',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
                'status' => 1,
                'cohort_id' => null,
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        // Usuarios INSTRUCTOR
        $instructors = [
            [
                'first_name' => 'Carlos',
                'last_name' => 'Rodríguez',
                'email' => 'carlos.rodriguez@sigpro.com',
                'password' => Hash::make('instructor123'),
                'role' => 'INSTRUCTOR',
                'status' => 1,
                'cohort_id' => null,
            ],
            [
                'first_name' => 'Ana',
                'last_name' => 'Martínez',
                'email' => 'ana.martinez@sigpro.com',
                'password' => Hash::make('instructor123'),
                'role' => 'INSTRUCTOR',
                'status' => 1,
                'cohort_id' => null,
            ],
            [
                'first_name' => 'Luis',
                'last_name' => 'Sánchez',
                'email' => 'luis.sanchez@sigpro.com',
                'password' => Hash::make('instructor123'),
                'role' => 'INSTRUCTOR',
                'status' => 1,
                'cohort_id' => null,
            ],
            [
                'first_name' => 'Patricia',
                'last_name' => 'López',
                'email' => 'patricia.lopez@sigpro.com',
                'password' => Hash::make('instructor123'),
                'role' => 'INSTRUCTOR',
                'status' => 1,
                'cohort_id' => null,
            ],
            [
                'first_name' => 'Roberto',
                'last_name' => 'Fernández',
                'email' => 'roberto.fernandez@sigpro.com',
                'password' => Hash::make('instructor123'),
                'role' => 'INSTRUCTOR',
                'status' => 1,
                'cohort_id' => null,
            ],
        ];

        foreach ($instructors as $instructor) {
            User::create($instructor);
        }

        // Usuarios STUDENT - Crear estudiantes para cada cohorte
        $cohorts = Cohort::all();
        $studentNames = [
            ['first_name' => 'Andrés', 'last_name' => 'Silva'],
            ['first_name' => 'Camila', 'last_name' => 'Torres'],
            ['first_name' => 'Felipe', 'last_name' => 'Reyes'],
            ['first_name' => 'Daniela', 'last_name' => 'Castro'],
            ['first_name' => 'Sebastián', 'last_name' => 'Morales'],
            ['first_name' => 'Valentina', 'last_name' => 'Ortiz'],
            ['first_name' => 'Nicolás', 'last_name' => 'Flores'],
            ['first_name' => 'Francisca', 'last_name' => 'Navarro'],
            ['first_name' => 'Cristóbal', 'last_name' => 'Rojas'],
            ['first_name' => 'Isidora', 'last_name' => 'Contreras'],
            ['first_name' => 'Matías', 'last_name' => 'Herrera'],
            ['first_name' => 'Javiera', 'last_name' => 'Guzmán'],
            ['first_name' => 'Benjamín', 'last_name' => 'Vargas'],
            ['first_name' => 'Antonia', 'last_name' => 'Muñoz'],
            ['first_name' => 'Vicente', 'last_name' => 'Fuentes'],
        ];

        $studentCounter = 1;
        foreach ($cohorts as $cohort) {
            // Asignar 5-8 estudiantes por cohorte
            $studentsPerCohort = rand(5, 8);
            for ($i = 0; $i < $studentsPerCohort && $studentCounter <= count($studentNames); $i++) {
                $name = $studentNames[$studentCounter - 1];
                User::create([
                    'first_name' => $name['first_name'],
                    'last_name' => $name['last_name'],
                    'email' => strtolower($name['first_name'] . '.' . $name['last_name'] . '@student.com'),
                    'password' => Hash::make('student123'),
                    'role' => 'STUDENT',
                    'status' => 1,
                    'cohort_id' => $cohort->id,
                ]);
                $studentCounter++;
            }
        }
        
        // Crear estudiantes adicionales con factory si se necesitan más
        if (env('APP_ENV') !== 'production') {
            User::factory(20)->student()->create();
        }
    }
}