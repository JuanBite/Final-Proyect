<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    // IMPORTANTE: Especificar que la tabla se llama 'region' (singular)
    protected $table = 'region';

    
    protected $fillable = [
        'name',
        'code',
    ];
    
    public $timestamps = true; // Si tu tabla tiene created_at y updated_at
    
    public function centers()
    {
        return $this->hasMany(Center::class);
    }
    
}