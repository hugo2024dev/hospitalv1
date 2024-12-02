<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaExamen extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cita_examen';

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
