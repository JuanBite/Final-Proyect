<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'file_path',
        'comments',
        'submitted_at',
        'grade',
        'feedback'
    ];

    // Relation

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
