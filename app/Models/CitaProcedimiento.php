<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CitaProcedimiento extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function procedimiento()
    {
        return $this->belongsTo(Procedimiento::class);
    }
}
