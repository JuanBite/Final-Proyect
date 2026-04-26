<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'task_id',
        'file_path',
        'original_filename',
        'mime_type',
        'comments',
        'submitted_at',
        'grade',
        'feedback',
        'week_number',
        'submission_month',
        'submission_year',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    // ── Relaciones ──────────────────────────────────────────────

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task()
    {
        return $this->belongsTo(ProjectTask::class, 'task_id');
    }

    // ── Helpers ─────────────────────────────────────────────────

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type ?? '', 'image/');
    }
}




