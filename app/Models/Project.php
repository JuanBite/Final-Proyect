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
        'cohort_id', 'center_id',  // ← nuevos
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

    // ─── Scope de visibilidad (usado en todos los controllers) ───────────────

    /**
     * Filtra proyectos según el rol del usuario.
     * Uso: Project::visibleTo(auth()->user())->get()
     */
    public function scopeVisibleTo($query, User $user)
    {
        return match ($user->role) {
            'ADMIN'          => $query,
            'REGIONAL_ADMIN' => $query->whereIn('center_id', $user->visibleCenterIds()),
            'COORDINATOR'    => $query->where('center_id', $user->center_id),
            'INSTRUCTOR'     => $query->where('center_id', $user->center_id),
            'STUDENT'        => $query->where('center_id', $user->center_id),
            default          => $query->whereRaw('0 = 1'), // nadie más ve nada
        };
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
}