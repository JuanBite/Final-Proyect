<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    public $timestamps = false; // NO tiene updated_at
    protected $fillable = [
    'name',
    'description',
    'start_date',
    'due_date',
    'progress',
    'leader_id',
    'status',
];

    // Relations
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
    public function task()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    public function users()
    {
    return $this->belongsToMany(
        User::class,
        'project_members',   // tabla intermedia
        'project_id',        // FK de este modelo
        'user_id'            // FK del otro modelo
    )->withPivot('project_role');
    }
    public function getProgressColorAttribute()
{
    if ($this->progress <= 30) {
        return '#FF5252';
    } elseif ($this->progress <= 70) {
        return '#FFD740';
    }
    return '#00C853';
}

public function getProgressOffsetAttribute()
{
    $radius = 18;
    $circumference = 2 * pi() * $radius;

    return $circumference - ($this->progress / 100) * $circumference;
}

public function getProgressCircumferenceAttribute()
{
    return 2 * pi() * 18;
}

    
}
