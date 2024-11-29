<?php

namespace App\Models;

use App\States\Cita\Asignado;
use App\States\Cita\CitaState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsTo(Paciente::class);
    }

    public function programacion()
    {
        return $this->belongsTo(Programacion::class);
    }

    public function triaje()
    {
        return $this->hasOne(Triaje::class);
    }

    public function anamnesis()
    {
        return $this->hasOne(Anamnesis::class);
    }

    public function scopeAsignados(Builder $query): void
    {
        $query->where('estado', (new Asignado($this)));
    }
}
