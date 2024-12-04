<?php

namespace App\Livewire;

use App\Models\Paciente;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;
use Livewire\Component;

class PacienteDetalle extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists, InteractsWithForms;
    private array $data = [];

    public function pacienteInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->state($this->data ?? [])
            ->schema([
                TextEntry::make('nombres'),
                TextEntry::make('apellido_paterno'),
                TextEntry::make('apellido_paterno'),
                TextEntry::make('fecha_nacimiento')
                    ->label('Edad')
                    ->formatStateUsing(fn($state): HtmlString => new HtmlString(Carbon::parse($state)->age)),
                TextEntry::make('direccion')
                    ->label('Domicilio'),
                TextEntry::make('telefono'),
                TextEntry::make('sexo'),
            ])->columns(3);
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            {{$this->pacienteInfoList}}
        </div>
        HTML;
    }

    #[On('historial-paciente-seleccionado')]
    function onPacienteSeleccionado(array $data): void
    {
        $this->data = $data;
    }
}
