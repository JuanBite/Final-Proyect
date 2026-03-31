<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends Model
{
    use HasFactory;
    public $timestamps = true; // Tiene created_at y updated_at
    protected $fillable = [
        'name',
        'code',
        'region_id'
    ];

    // Relation
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
