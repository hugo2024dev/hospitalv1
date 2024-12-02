<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'codigo',
        'precio',
        'categoria_id',
        'is_active',
        'tipo',
        'parent_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function citas()
    {
        return $this->belongsToMany(Cita::class)
            ->withPivot([
                'cantidad',
            ])
            ->using(CitaExamen::class);
    }
}
