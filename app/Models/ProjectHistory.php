<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectHistory extends Model
{
    use HasFactory;
public $timestamps = false; // NO tiene updated_at
    protected $fillable = [
        'project_id',
        'action',
        'performed_by'
    ];
    //Relations
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
