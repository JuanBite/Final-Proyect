<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TaskEnum;

class ProjectTask extends Model
{
    use HasFactory;

    protected $table = 'project_tasks';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'phase',
        'sort_order',
        'title',
        'description',
        'start_date',
        'due_date',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date'   => 'date',
        'status'     => TaskEnum::class,
    ];

    // ── Relaciones ──────────────────────────────────────────────

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'task_id');
    }

    // ── Helpers ─────────────────────────────────────────────────

    /**
     * Devuelve las entregas agrupadas por semana (1-4) para un mes/año dado.
     */
    public function submissionsForMonth(int $year, int $month): array
    {
        $byWeek = [];
        for ($w = 1; $w <= 4; $w++) {
            $byWeek[$w] = $this->submissions()
                ->where('submission_year', $year)
                ->where('submission_month', $month)
                ->where('week_number', $w)
                ->get();
        }
        return $byWeek;
    }
}