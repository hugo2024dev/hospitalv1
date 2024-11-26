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
    protected bool $dateClickEnabled = true;
    protected ?string $locale = 'es';

    public ?string $especialidad;
    public ?string $medico;

    public function onDateClick(array $info = []): void
    {
        dd($info);
        // Validate the data
        // $info contains the event data:
        // $info['date'] - the date clicked on
        // $info['dateStr'] - the date clicked on as a UTC string
        // $info['allDay'] - whether the date is an all-day slot
        // $info['view'] - the view object
        // $info['resource'] - the resource object
    }

    public function getEvents(array $fetchInfo = []): Collection|array
    {
        $query = Programacion::query();
        if (isset($this->especialidad)) {
            $query->whereEspecialidadId($this->especialidad);
        }
        return [
            // Chainable object-oriented variant
            // Event::make()
            //     ->title('My first event')
            //     ->start(now()->subHour())
            //     ->end(now()->addHour()),

            // // Array variant
            // ['title' => 'My second event', 'start' => today()->addDays(3), 'end' => today()->addDays(3)],

            // Eloquent model implementing the `Eventable` interface
            ...$query->get(),
            // MyEvent::find(1),
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
