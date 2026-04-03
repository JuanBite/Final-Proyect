<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMember extends Model
{
    protected $table = 'project_members';
    
    Use HasFactory;
    public $timestamps = false; // NO tiene updated_at
    protected $fillable = [
        'project_id',
        'user_id',
        'project_role'
    ];

    // Relation

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
