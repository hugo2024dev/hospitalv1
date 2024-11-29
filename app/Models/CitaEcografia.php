<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaEcografia extends Pivot
{
    use HasFactory;
    protected $table = 'cita_ecografia';
    public $timestamps = false;

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function ecografia()
    {
        return $this->belongsTo(Ecografia::class);
    }
}
