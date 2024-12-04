<?php
namespace App\States\Cita;

class Finalizado extends CitaState
{
    public static $name = 'finalizado';

    public function color(): string
    {
        return 'primary';
    }

    public function display(): string
    {
        return 'Finalizado';
    }
}
