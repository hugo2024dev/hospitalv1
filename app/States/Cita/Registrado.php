<?php
namespace App\States\Cita;

class Registrado extends CitaState
{
    public static $name = 'registrado';

    public function color(): string
    {
        return 'gray';
    }

    public function display(): string
    {
        return 'Registrado';
    }
}
