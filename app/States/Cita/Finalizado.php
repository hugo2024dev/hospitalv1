<?php
namespace App\States\Cita;

class Finalizado extends CitaState
{
    public static $name = 'finalizado';

    public function color(): string
    {
        return 'success';
    }

    public function display(): string
    {
        return 'Finalizado';
    }
}
