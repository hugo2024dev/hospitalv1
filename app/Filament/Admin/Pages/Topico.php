<?php

namespace App\Filament\Admin\Pages;

use App\Models\Cita;
use App\States\Cita\Asignado;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class Topico extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.topico';

    public function table(Table $table): Table
    {
        return $table
            ->query(Cita::query()->whereState('estado', Asignado::class))
            ->columns([
                Tables\Columns\TextColumn::make('numero_orden')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paciente.numero_documento')
                    ->label('N° Documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('paciente.nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hora_inicio'),
                Tables\Columns\TextColumn::make('hora_fin'),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn(Cita $record) => $record->estado->color())
                    ->searchable(),
                IconColumn::make('hora_fin')
                    ->label('¿Triaje?')
                    ->color(fn(Cita $record): string => isset ($record->triaje) ? 'success' : 'danger')
                    ->icon(fn(Cita $record): string => isset ($record->triaje) ? 'tabler-check' : 'tabler-x'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('triaje')
                    ->icon('tabler-activity-heartbeat')
                    ->hiddenLabel()
                    ->tooltip('Triaje')
                    ->fillForm(fn(Cita $record): array => $record->triaje ? $record->triaje->toArray() : [])
                    ->form([
                        Group::make()
                            ->schema([
                                Fieldset::make('Signos Vitales')
                                    ->schema([
                                        TextInput::make('temperatura')
                                            ->numeric()
                                            ->suffix('°C'),
                                        TextInput::make('presion_arterial')
                                            ->suffix('xmmHg'),
                                        TextInput::make('saturacion')
                                            ->numeric()
                                            ->suffix('%'),
                                        TextInput::make('frecuencia_cardiaca')
                                            ->numeric()
                                            ->suffix('x min'),
                                        TextInput::make('frecuencia_respiratoria')
                                            ->numeric()
                                            ->suffix('x min'),
                                    ])->columns(3),
                                Fieldset::make('Datos antropométricos')
                                    ->schema([
                                        TextInput::make('peso')
                                            ->numeric()
                                            ->suffix('Kg'),
                                        TextInput::make('talla')
                                            ->numeric()
                                            ->suffix('m.'),
                                        TextInput::make('perimetro_abdominal')
                                            ->numeric()
                                            ->suffix('cm.'),
                                    ])->columns(3)
                            ])
                            ->columns(2)
                    ])
                    ->modalSubmitActionLabel('Guardar')
                    ->action(function (array $data, Cita $record): void {
                        if (isset($record->triaje)) {
                            $record->triaje()->update($data);
                        } else {
                            $record->triaje()->create($data);

                        }
                        Notification::make()
                            ->title('Triaje registrado correctamente.')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
