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
        $user = new User;
        $user->first_name = 'Carlos';
        $user->last_name = 'Rodríguez';
        $user->email = 'carlos.rodriguez@sigpro.com';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Ana';
        $user->last_name = 'Martínez';
        $user->email = 'ana.martinez@sigpro.com';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Luis';
        $user->last_name = 'Sánchez';
        $user->email = 'luis.sanchez@sigpro.com';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Patricia';
        $user->last_name = 'López';
        $user->email = 'patricia.lopez@sigpro.com';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Roberto';
        $user->last_name = 'Fernández';
        $user->email = 'roberto.fernandez@sigpro.com';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        // Usuarios STUDENT
        $user = new User;
        $user->first_name = 'Andrés';
        $user->last_name = 'Silva';
        $user->email = 'andres.silva@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Camila';
        $user->last_name = 'Torres';
        $user->email = 'camila.torres@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Felipe';
        $user->last_name = 'Reyes';
        $user->email = 'felipe.reyes@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Daniela';
        $user->last_name = 'Castro';
        $user->email = 'daniela.castro@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 2;
        $user->save();

        $user = new User;
        $user->first_name = 'Sebastián';
        $user->last_name = 'Morales';
        $user->email = 'sebastian.morales@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 2;
        $user->save();

        $user = new User;
        $user->first_name = 'Valentina';
        $user->last_name = 'Ortiz';
        $user->email = 'valentina.ortiz@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 3;
        $user->save();

        $user = new User;
        $user->first_name = 'Nicolás';
        $user->last_name = 'Flores';
        $user->email = 'nicolas.flores@student.com';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 3;
        $user->save();
    }
}