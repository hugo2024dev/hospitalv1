<?php

namespace App\Models;

use App\Enums\Diagnostico\TipoDiagnosticoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaDiagnostico extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    // protected $fillable = ['codigo', 'nombre'];

    protected $casts = [
        'tipo' => TipoDiagnosticoEnum::class,
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class);
    }
}
