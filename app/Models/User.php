<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Especificar que NO usa timestamps
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'document',
        'password',
        'role',
        'status',
        'cohort_id',
        'center_id',
    ];

    protected $hidden = [
        'password',
    ];

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
        return $this->hasMany(Task::class, 'assigned_to');
    }
    public function projectMembers()
    {
        return $this->hasMany(\App\Models\ProjectMember::class, 'user_id');
    }

    // Permite que estudiante y instructor puedan ser lider de proyecto.
    public function getProjectRoleAttribute()
    {
        return optional($this->projectMembers->first())->project_role;
    }
}
