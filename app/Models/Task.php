<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'start_date',
        'due_date',
        'status',
        'assigned_to'
    ];

    // Relation 
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
