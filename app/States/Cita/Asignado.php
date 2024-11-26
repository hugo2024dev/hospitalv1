<?php
namespace App\States\Cita;

class Asignado extends CitaState
{
    public static $name = 'asignado';

    public function color(): string
    {
        return 'warning';
    }

    public function display(): string
    {
        return 'Asignado';
    }
}
