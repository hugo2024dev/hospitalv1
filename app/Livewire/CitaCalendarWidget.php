<?php

namespace App\Livewire;

use App\Models\Programacion;
use Filament\Widgets\Widget;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Widgets\CalendarWidget;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class CitaCalendarWidget extends CalendarWidget
{
    protected bool $eventClickEnabled = true;
    protected ?string $locale = 'es';

    public ?string $especialidad;
    public ?string $medico;

    public function onEventClick(array $info = [], ?string $action = null): void
    {
        // dd($info);
        $this->dispatch('cita-programacion-selected', $info['event']['extendedProps']['key']);
        // do something on click
        // $info contains the event data:
        // $info['event'] - the event object
        // $info['view'] - the view object
    }

    public function getEvents(array $fetchInfo = []): Collection|array
    {
        $query = Programacion::query();
        if (isset($this->especialidad)) {
            $query->whereEspecialidadId($this->especialidad);
        }
        return [
            ...$query->get(),
        ];
    }

    #[On('cita-filter-applied')]
    public function xd($data)
    {
        $this->especialidad = $data['especialidad'];
        $this->medico = $data['medico'];
        $this->refreshRecords();
    }
}
