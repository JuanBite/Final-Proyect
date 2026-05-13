<?php
// app/Policies/UserPolicy.php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR']);
    }

    public function view(User $user, User $target): bool
    {
        if ($user->id === $target->id) return true;

        return match ($user->role) {
            'ADMIN'          => true,
            'REGIONAL_ADMIN' => in_array($target->center_id, $user->visibleCenterIds()),
            'COORDINATOR'    => $target->center_id === $user->center_id,
            'INSTRUCTOR'     => $target->cohort_id === $user->cohort_id,
            default          => false,
        };
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR']);
    }

    public function update(User $user, User $target): bool
    {
        if ($user->id === $target->id) return true; // cualquiera edita su propio perfil

        return match ($user->role) {
            'ADMIN'          => true,
            'REGIONAL_ADMIN' => in_array($target->center_id, $user->visibleCenterIds())
                                && !$target->isAdmin(),
            // Coordinador solo gestiona instructores y aprendices de su centro
            'COORDINATOR'    => $target->center_id === $user->center_id
                                && $target->hasRole(['INSTRUCTOR', 'STUDENT']),
            default          => false,
        };
    }

    public function delete(User $user, User $target): bool
    {
        if ($user->id === $target->id) return false; // nadie se elimina a sí mismo

        return match ($user->role) {
            'ADMIN'          => !$target->isAdmin(),
            'REGIONAL_ADMIN' => in_array($target->center_id, $user->visibleCenterIds())
                                && !$target->isAdmin(),
            'COORDINATOR'    => $target->center_id === $user->center_id
                                && $target->hasRole(['INSTRUCTOR', 'STUDENT']),
            default          => false,
        };
    }
}