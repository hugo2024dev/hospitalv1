<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProgramacionForm extends Form
{
    //
    #[Validate('required|numeric|min:1')]
    public $cantidad_citas = '';

    #[Validate('required|numeric|min:1')]
    public $duracion_cita;

    #[Validate('required|exists:empleados,id', as: 'medico')]
    public $empleado_id;

    #[Validate('required|exists:consultorios,id', as: 'consultorio')]
    public $consultorio_id;

    #[Validate('required|exists:especialidads,id', as: 'especialidad')]
    public $especialidad_id;

    #[Validate([
        'arr_fechas' => [
            'required',
            'array',
            'min:1'
        ],
        'arr_fechas.*.fecha' => [
            'date',
            'required'
        ],
        'arr_fechas.*.turno' => [
            'string',
            'required'
        ],
    ], as: [
        'arr_fechas' => 'fechas',
        'arr_fechas.*.fecha' => 'fecha',
        'arr_fechas.*.turno' => 'turno',
    ]
    )]
    public array $arr_fechas = [];
}
