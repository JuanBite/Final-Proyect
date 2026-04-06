<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectMember;
use App\Models\User;
use App\Models\Project;

class ProjectMemberSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Proyecto 1
            ['project_id' => 1, 'user_id' => 3, 'role' => 'LEADER'],
            ['project_id' => 1, 'user_id' => 8, 'role' => 'MEMBER'],
            ['project_id' => 1, 'user_id' => 9, 'role' => 'MEMBER'],
            ['project_id' => 1, 'user_id' => 10, 'role' => 'MEMBER'],

            // Proyecto 2
            ['project_id' => 2, 'user_id' => 4, 'role' => 'LEADER'],
            ['project_id' => 2, 'user_id' => 9, 'role' => 'MEMBER'],
            ['project_id' => 2, 'user_id' => 2, 'role' => 'MEMBER'],

            // Proyecto 3
            ['project_id' => 3, 'user_id' => 5, 'role' => 'LEADER'],
            ['project_id' => 3, 'user_id' => 1, 'role' => 'MEMBER'],
            ['project_id' => 3, 'user_id' => 7, 'role' => 'MEMBER'],
        ];

        foreach ($data as $item) {

            $user = User::find($item['user_id']);
            $project = Project::find($item['project_id']);

            // 🔥 VALIDACIÓN CLAVE
            if ($user && $project) {
                ProjectMember::create([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'project_role' => $item['role'],
                ]);
            }
        }
    }
}