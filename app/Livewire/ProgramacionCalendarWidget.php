<?php

namespace App\Livewire;

use App\Models\Programacion;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Widgets\CalendarWidget;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class ProgramacionCalendarWidget extends CalendarWidget
{
    protected bool $dateClickEnabled = true;
    protected ?string $locale = 'es';

    public array $eventos = [];

    public function onDateClick(array $info = []): void
    {
        $this->dispatch('programacion-date-clicked', $info);
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
        return [
            ...$this->eventos
        ];
    }

    #[On('programacion-array-updated')]
    public function xd($data)
    {
        $this->eventos = [];
        foreach ($data as $value) {
            $this->eventos[] = [
                'title' => 'M',
                'start' => Carbon::parse($value['fecha']),
                'end' => Carbon::parse($value['fecha'])
            ];
        }
        $this->refreshRecords();
    }
}
