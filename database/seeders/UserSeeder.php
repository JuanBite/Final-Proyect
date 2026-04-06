<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================

        $user = new User;
        $user->first_name = 'Juan';
        $user->last_name = 'Pérez';
        $user->email = 'admin@sigpro.com';
        $user->document = '12345678917';
        $user->password = Hash::make('admin123');
        $user->role = 'ADMIN';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'María';
        $user->last_name = 'González';
        $user->email = 'superadmin@sigpro.com';
        $user->document = '12345678914';
        $user->password = Hash::make('admin123');
        $user->role = 'ADMIN';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();


        // =========================
        // INSTRUCTORES
        // =========================

        $user = new User;
        $user->first_name = 'Carlos';
        $user->last_name = 'Rodríguez';
        $user->email = 'carlos.rodriguez@sigpro.com';
        $user->document = '12345678912';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Ana';
        $user->last_name = 'Martínez';
        $user->email = 'ana.martinez@sigpro.com';
        $user->document = '12345678922';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();

        $user = new User;
        $user->first_name = 'Luis';
        $user->last_name = 'Sánchez';
        $user->email = 'luis.sanchez@sigpro.com';
        $user->document = '12345678923';
        $user->password = Hash::make('instructor123');
        $user->role = 'INSTRUCTOR';
        $user->status = 1;
        $user->cohort_id = null;
        $user->save();


        // =========================
        // STUDENTS
        // =========================

        $user = new User;
        $user->first_name = 'Andrés';
        $user->last_name = 'Silva';
        $user->email = 'andres.silva@student.com';
        $user->document = '12345678931';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Camila';
        $user->last_name = 'Torres';
        $user->email = 'camila.torres@student.com';
        $user->document = '12345678932';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Felipe';
        $user->last_name = 'Reyes';
        $user->email = 'felipe.reyes@student.com';
        $user->document = '12345678933';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 1;
        $user->save();

        $user = new User;
        $user->first_name = 'Daniela';
        $user->last_name = 'Castro';
        $user->email = 'daniela.castro@student.com';
        $user->document = '12345678934';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 2;
        $user->save();

        $user = new User;
        $user->first_name = 'Sebastián';
        $user->last_name = 'Morales';
        $user->email = 'sebastian.morales@student.com';
        $user->document = '12345678935';
        $user->password = Hash::make('student123');
        $user->role = 'STUDENT';
        $user->status = 1;
        $user->cohort_id = 2;
        $user->save();
    }
}