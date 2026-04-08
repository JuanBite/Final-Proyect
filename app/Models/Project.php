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
    return match (true) {
        $this->progress <= 30 => '#ef4444', // rojo moderno (Tailwind red-500)
        $this->progress <= 70 => '#facc15', // amarillo (yellow-400)
        default => '#22c55e',              // verde (green-500)
    };
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

protected $casts = [
    'start_date' => 'date',
    'due_date' => 'date',
];

public function members()
{
    return $this->belongsToMany(User::class, 'project_members')
                ->withPivot('project_role');
}

public function leader()
{
    return $this->belongsTo(User::class, 'leader_id');
}

public function leaderViaMembers()
{
    return $this->belongsToMany(User::class, 'project_members')
                ->withPivot('project_role')
                ->wherePivot('project_role', 'LEADER');
}

public function team()
{
    return $this->belongsToMany(User::class, 'project_members')
                ->withPivot('project_role')
                ->wherePivot('project_role', 'MEMBER');
}
    
}
