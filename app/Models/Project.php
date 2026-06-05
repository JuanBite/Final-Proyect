<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'start_date', 'due_date',
        'progress', 'leader_id', 'status',
        'cohort_id', 'center_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date'   => 'date',
    ];

    // ─── Relaciones ──────────────────────────────────────────────────────────

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withPivot('project_role');
    }

    public function team()
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withPivot('project_role')
            ->wherePivot('project_role', 'MEMBER');
    }

    public function leaderViaMembers()
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withPivot('project_role')
            ->wherePivot('project_role', 'LEADER');
    }

    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // ─── Scope de visibilidad ─────────────────────────────────────────────────

    public function scopeVisibleTo($query, User $user)
    {
        return match ($user->role) {
            'ADMIN'          => $query,
            'REGIONAL_ADMIN' => $query->whereIn('center_id', $user->visibleCenterIds()),
            'COORDINATOR'    => $query->where('center_id', $user->center_id),
            'INSTRUCTOR'     => $query->whereIn('cohort_id', $user->visibleCohortIds()),
            'STUDENT'        => $query->where('cohort_id', $user->cohort_id),
            default          => $query->whereRaw('0 = 1'),
        };
    }

    // ─── Status automático ────────────────────────────────────────────────────

    /**
     * Recalcula y guarda el status según las reglas:
     *  - progress >= 100                          → COMPLETED
     *  - días restantes <= 14 AND progress < 70   → DELAYED
     *  - cualquier otro caso                      → IN_PROGRESS
     */
    public function recalculateStatus(): void
    {
        $daysLeft = (int) ceil(now()->floatDiffInDays($this->due_date, false));

        $newStatus = match (true) {
            $this->progress >= 100                      => 'COMPLETED',
            $daysLeft <= 14 && $this->progress < 70     => 'DELAYED',
            default                                     => 'IN_PROGRESS',
        };

        if ($this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
        }
    }

    // ─── Atributos calculados ─────────────────────────────────────────────────

    public function getProgressColorAttribute(): string
    {
        return match (true) {
            $this->progress <= 30 => '#ef4444',
            $this->progress <= 70 => '#facc15',
            default               => '#22c55e',
        };
    }

    public function getProgressOffsetAttribute(): float
    {
        $circumference = 2 * pi() * 18;
        return $circumference - ($this->progress / 100) * $circumference;
    }

    public function getProgressCircumferenceAttribute(): float
    {
        return 2 * pi() * 18;
    }

    public function getStatusLabelAttribute(): string
    {
        $map = [
            'in_progress' => 'En progreso',
            'completed'   => 'Completado',
            'delayed'     => 'Retrasado',
        ];

        $key = strtolower($this->status ?? '');

        return $map[$key] ?? ucwords(str_replace('_', ' ', $key));
    }
}