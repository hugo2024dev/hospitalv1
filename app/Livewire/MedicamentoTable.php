<?php

namespace App\Livewire;

use App\Models\CitaMedicamento;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;

class MedicamentoTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public int $citaId;

    public function mount(int $citaId): void
    {
        $this->citaId = $citaId;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(CitaMedicamento::query()->where('cita_id', $this->citaId))
            ->defaultPaginationPageOption(5)
            ->deferLoading()
            ->columns([
                TextColumn::make('cita.programacion.fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('cita.hora_inicio')
                    ->label('Hora')
                    ->time()
                    ->sortable(),
                TextColumn::make('cita.programacion.especialidad.nombre')
                    ->label('Especialidad'),
                TextColumn::make('medicamento.nombre')
                    ->label('Item')
                    ->formatStateUsing(fn(CitaMedicamento $record) =>
                        $record->medicamento->nombre . ' ' .
                        $record->dosis->nombre . '-' . $record->unidad->nombre)
                    ->wrap(),
                TextColumn::make('cantidad'),
                TextColumn::make('cita.programacion.empleado.nombres')
                    ->label('Medico'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.medicamento-table');
    }

    #[On('historial-cita-seleccionada')]
    function onCitaSeleccionada(int $data): void
    {
        // dd($data);
        $this->citaId = $data;
        $this->resetTable();
    }
}
