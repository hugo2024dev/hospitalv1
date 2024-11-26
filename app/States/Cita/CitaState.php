<?php
namespace App\States\Cita;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\App\Models\Cita>
 */
abstract class CitaState extends State
{
    abstract public function color(): string;
    abstract public function display(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Registrado::class)
            ->allowTransition(Registrado::class, Asignado::class)
            // ->allowTransition(Iniciado::class, Finalizado::class)
            // ->allowTransition(Finalizado::class, Evaluado::class)
        ;
    }

    public function transitionableStatesFormatted(): array
    {
        return collect($this->transitionableStates())
            ->mapWithKeys(function ($state) {
                $stateClass = 'App\\States\\Cita\\' . ucfirst($state);
                return [$state => (new $stateClass($this))->display()];
            })
            ->toArray();
    }
}
