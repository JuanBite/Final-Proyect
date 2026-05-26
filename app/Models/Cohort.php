<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    public $timestamps = true; // Tiene created_at y updated_at

    protected $fillable = [
        'cohort_number',
        'program_name',
        'center_id',
        'start_date',
        'end_date',
    ];

    // Relations
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'cohort_user')
            ->where('role', 'INSTRUCTOR');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
