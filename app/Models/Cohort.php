<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cohort extends Model
{
    use HasFactory;
public $timestamps = true; // Tiene created_at y updated_at
    protected $fillable = [
        'cohort_number',
        'program_name',
        'center_id',
        'start_date',
        'end_date'
    ];
    //Relations
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
