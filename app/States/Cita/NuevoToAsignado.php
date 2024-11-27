<?php
namespace App\States\Cita;
use App\Models\Cita;
use Spatie\ModelStates\Transition;

class NuevoToAsignado extends Transition
{
    private Cita $cita;

    private string $user_id;
    private string $paciente_id;

    public function __construct(Cita $cita, string $user_id, string $paciente_id)
    {
        $this->cita = $cita;
        $this->user_id = $user_id;
        $this->paciente_id = $paciente_id;

    }

    public function handle(): Cita
    {
        $this->cita->estado = new Asignado($this->cita);
        // $this->cita->failed_at = now();
        $this->cita->user_id = $this->user_id;
        $this->cita->paciente_id = $this->paciente_id;
        $this->cita->save();

        return $this->cita;
    }
}