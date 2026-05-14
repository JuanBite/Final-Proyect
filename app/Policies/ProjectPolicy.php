<?php
// app/Policies/ProjectPolicy.php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    // El controller filtra con scopeVisibleTo(), aquí solo validamos acceso individual

    public function viewAny(User $user): bool
    {
        return true; // todos ven la lista, filtrada por scope en el controller
    }

    public function view(User $user, Project $project): bool
    {
        return match ($user->role) {
            'ADMIN'          => true,
            'REGIONAL_ADMIN' => in_array($project->center_id, $user->visibleCenterIds()),
            'COORDINATOR'    => $project->center_id === $user->center_id,
            'INSTRUCTOR',
            'STUDENT'        => $project->cohort_id === $user->cohort_id,
            default          => false,
        };
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR', 'STUDENT']);
    }

    public function update(User $user, Project $project): bool
    {
        return match ($user->role) {
            'ADMIN'          => true,
            'REGIONAL_ADMIN' => in_array($project->center_id, $user->visibleCenterIds()),
            'COORDINATOR'    => $project->center_id === $user->center_id,
            // El instructor solo edita si es líder del proyecto
            'STUDENT'     => $project->cohort_id === $user->cohort_id
                                && $project->leader_id === $user->id,
            default          => false,
        };
    }

    public function delete(User $user, Project $project): bool
    {
        return match ($user->role) {
            'ADMIN'          => true,
            'REGIONAL_ADMIN' => in_array($project->center_id, $user->visibleCenterIds()),
            'COORDINATOR'    => $project->center_id === $user->center_id, 
            'STUDENT'        => $project->center_id === $user->center_id, 
            default          => false,
        };
    }
}