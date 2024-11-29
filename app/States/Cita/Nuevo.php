<?php
namespace App\States\Cita;

class Nuevo extends CitaState
{
    public static $name = 'nuevo';

    public function color(): string
    {
        return 'gray';
    }

    public function display(): string
    {
        return 'Nuevo';
    }
}
