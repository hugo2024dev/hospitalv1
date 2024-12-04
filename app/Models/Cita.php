<?php

namespace App\Models;

use App\States\Cita\Asignado;
use App\States\Cita\CitaState;
use App\States\Cita\Finalizado;
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

    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnostico::class)
            ->withPivot(['tipo'])
            ->using(CitaDiagnostico::class);
    }

    public function procedimientos()
    {
        return $this->belongsToMany(Procedimiento::class)->using(CitaProcedimiento::class);
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class)
            ->withPivot(['cantidad', 'dosis_id', 'unidad_id', 'frecuencia_id', 'via_id', 'dias'])
            ->using(CitaMedicamento::class);
    }

    public function rayosxes()
    {
        return $this->belongsToMany(Rayosx::class)
            ->withPivot(['cantidad'])
            ->using(CitaRayosx::class);
    }

    public function ecografias()
    {
        return $this->belongsToMany(Ecografia::class)
            ->withPivot(['cantidad'])
            ->using(CitaEcografia::class);
    }

    public function examens()
    {
        return $this->belongsToMany(Examen::class)
            ->withPivot([
                'cantidad',
            ])
            ->using(CitaExamen::class);
    }

    //Filament relationship para el repeater
    public function citaDiagnosticos()
    {
        return $this->hasMany(CitaDiagnostico::class);
    }

    public function citaProcedimientos()
    {
        return $this->hasMany(CitaProcedimiento::class);
    }

    public function citaMedicamentos()
    {
        return $this->hasMany(CitaMedicamento::class);
    }

    public function citaRayosxes()
    {
        return $this->hasMany(CitaRayosx::class);
    }

    public function citaEcografias()
    {
        return $this->hasMany(CitaEcografia::class);
    }

    public function citaExamens()
    {
        return $this->hasMany(CitaExamen::class);
    }

    public function scopeAsignados(Builder $query): void
    {
        $query->whereState('estado', [Asignado::class, Finalizado::class]);
    }

    public function scopeOwned(Builder $query): void
    {
        $query->whereHas('programacion', function ($q) {
            $q->where('empleado_id', auth()->user()->empleado_id);
        });
    }

    public function getDocumentosAttribute()
    {
        $data = [];
        if ($this->rayosxes()->exists()) {
            $data['rayosx'] = [
                'url' => 'cita-rayosx',
                'label' => 'Rayosx',
            ];
        }
        if ($this->medicamentos()->exists()) {
            $data['receta'] = [
                'url' => 'cita-receta',
                'label' => 'Receta',
            ];
        }

        if ($this->ecografias()->exists()) {
            $data['ecografia'] = [
                'url' => 'cita-ecografia',
                'label' => 'Ecografia',
            ];
        }

        if ($this->examens()->exists()) {
            $data['examen'] = [
                'url' => 'cita-examen',
                'label' => 'examen',
            ];
        }

        return $data;
    }

}
