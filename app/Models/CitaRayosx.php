<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaRayosx extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function rayosx()
    {
        return $this->belongsTo(Rayosx::class);
    }
}
