<?php

namespace App\Models;

use App\States\Cita\CitaState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Cita extends Model
{
    use HasFactory;
    use HasStates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero_orden',
        'hora_inicio',
        'hora_fin',
        'estado',
        'user_id',
        'paciente_id',
        'programacion_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'numero_orden' => 'int',
        'estado' => CitaState::class,
    ];

    public function paciente()
    {
        // $this->estado->equa;
        return $this->belongsTo(Paciente::class);
    }

    public function programacion()
    {
        // $this->estado->equa;
        return $this->belongsTo(Programacion::class);
    }
}
