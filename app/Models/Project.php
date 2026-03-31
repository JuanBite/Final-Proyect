<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "password",
        "role",
        "status",
        "cohort_id ",
    ];

    // Relations
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_members')
                    ->withPivot('project_role');
    }  
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
    public function task()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }


    
}
