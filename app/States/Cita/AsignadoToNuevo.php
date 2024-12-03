<?php
namespace App\States\Cita;
use App\Models\Cita;
use Spatie\ModelStates\Transition;

class AsignadoToNuevo extends Transition
{
    private Cita $cita;


    public function __construct(Cita $cita)
    {
        $this->cita = $cita;

    }

    public function handle(): Cita
    {
        $this->cita->estado = new Nuevo($this->cita);
        $this->cita->user_id = null;
        $this->cita->paciente_id = null;
        $this->cita->save();

        return $this->cita;
    }
}