<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaMedicamento extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'cantidad' => 'int',
        'dias' => 'int',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function dosis()
    {
        return $this->belongsTo(Dosis::class);
    }
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
    public function frecuencia()
    {
        return $this->belongsTo(Frecuencia::class);
    }

    public function via()
    {
        return $this->belongsTo(Via::class);
    }
}
