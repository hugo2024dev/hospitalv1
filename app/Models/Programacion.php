<?php

namespace App\Models;

use App\Enums\Programacion\TurnoEnum;
use Carbon\Carbon;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model implements Eventable
{
    use HasFactory;

    protected $fillable = [
        'cantidad_citas',
        'fecha',
        'duracion_cita',
        'turno',
        'empleado_id',
        'consultorio_id',
        'especialidad_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'cantidad_citas' => 'int',
        'duracion_cita' => 'int',
        'turno' => TurnoEnum::class,
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function getFechaHoraInicioAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->fecha->toDateString());
    }

    public function getHoraInicioAttribute()
    {
        return match ($this->turno) {
            TurnoEnum::MAÑANA => '7:30',
            TurnoEnum::TARDE => '13:00',
        };
    }

    public function toEvent(): Event|array
    {
        return Event::make($this)
            ->title($this->especialidad->nombre)
            ->start($this->fecha_hora_inicio)
            ->end($this->fecha_hora_inicio)
            ->extendedProp('turno', $this->turno);
    }
}
