<?php

namespace App\Livewire;

use App\Models\Cita;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
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

    private $pacienteId;
    public function table(Table $table): Table
    {
        return $table
            ->query(Cita::query())
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereRaw('paciente_id = ?', [$this->pacienteId]);
                // if (isset($this->pacienteId)) {
                // }
            })
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
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.cita-table');
    }

    #[On('historial-paciente-seleccionado')]
    function onPacienteSeleccionado(array $data): void
    {
        empty($data) ? $this->pacienteId = null : $this->pacienteId = $data['id'];

    }
}
