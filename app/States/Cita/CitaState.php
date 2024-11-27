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
            ->default(Nuevo::class)
            ->allowTransition(Nuevo::class, Asignado::class, NuevoToAsignado::class)
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
