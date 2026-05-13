<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'document',
        'password', 'role', 'status',
        'region_id', 'center_id', 'cohort_id',
    ];

    protected $hidden = ['password'];

    // ─── Relaciones ──────────────────────────────────────────────────────────

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'user_id', 'project_id')
            ->withPivot('project_role');
    }

    public function ledProjects()
    {
        return $this->hasMany(Project::class, 'leader_id');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'assigned_to');
    }

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class, 'user_id');
    }

    // ─── Helpers de rol ──────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    public function isRegionalAdmin(): bool
    {
        return $this->role === 'REGIONAL_ADMIN';
    }

    public function isCoordinator(): bool
    {
        return $this->role === 'COORDINATOR';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'INSTRUCTOR';
    }

    public function isStudent(): bool
    {
        return $this->role === 'STUDENT';
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles);
    }

    /**
     * IDs de centros que este usuario puede ver.
     * Usado en Policies y Scopes para filtrar queries.
     */
    public function visibleCenterIds(): array
    {
        return match ($this->role) {
            'ADMIN' => Center::pluck('id')->toArray(),
            'REGIONAL_ADMIN' => Center::where('region_id', $this->region_id)->pluck('id')->toArray(),
            'COORDINATOR',
            'INSTRUCTOR',
            'STUDENT' => $this->center_id ? [$this->center_id] : [],
            default => [],
        };
    }

    /**
     * IDs de fichas (cohorts) que este usuario puede ver.
     */
    public function visibleCohortIds(): array
    {
        return match ($this->role) {
            'ADMIN' => Cohort::pluck('id')->toArray(),
            'REGIONAL_ADMIN' => Cohort::whereIn('center_id', $this->visibleCenterIds())->pluck('id')->toArray(),
            'COORDINATOR' => Cohort::where('center_id', $this->center_id)->pluck('id')->toArray(),
            'INSTRUCTOR',
            'STUDENT' => $this->cohort_id ? [$this->cohort_id] : [],
            default => [],
        };
    }

    /**
     * ¿Puede este usuario gestionar un centro específico?
     */
    public function canManageCenter(int $centerId): bool
    {
        return match ($this->role) {
            'ADMIN' => true,
            'REGIONAL_ADMIN' => in_array($centerId, $this->visibleCenterIds()),
            'COORDINATOR' => $this->center_id === $centerId,
            default => false,
        };
    }

    public function getProjectRoleAttribute()
    {
        return optional($this->projectMembers->first())->project_role;
    }
}
