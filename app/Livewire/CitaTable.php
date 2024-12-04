<?php

namespace App\Livewire;

use App\Models\Cita;
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

class CitaTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public int $pacienteId;

    public function mount(int $pacienteId): void
    {
        $this->pacienteId = $pacienteId;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Cita::query()->where('paciente_id', $this->pacienteId))
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('programacion.fecha')
                    ->label('Fecha ingreso')
                    ->date()
                    ->sortable(),
                TextColumn::make('hora_inicio')
                    ->label('Hora ingreso')
                    ->time()
                    ->sortable(),
                TextColumn::make('programacion.especialidad.nombre')
                    ->label('Especialidad'),
                TextColumn::make('anamnesis.motivo_consulta')
                    ->label('Motivo')
                    ->wrap(),
                TextColumn::make('diagnosticos.nombre')
                    ->label('Dx')
                    ->wrap()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->expandableLimitedList(),
                TextColumn::make('procedimientos.nombre')
                    ->label('Tratamiento')
                    ->wrap()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->expandableLimitedList(),
                TextColumn::make('programacion.empleado.nombres')
                    ->label('Medico'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('agg')
                    ->hiddenLabel()
                    ->icon('tabler-circle-check')
                    ->color('warning')
                    // ->requiresConfirmation()
                    ->action(function (Cita $record) {
                        $this->dispatch('historial-cita-seleccionada', data: $record->id, documentos: $record->documentos);
                        Notification::make()
                            ->title('Cita seleccionada correctamente')
                            ->success()
                            ->send();
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.cita-table');
    }
}
