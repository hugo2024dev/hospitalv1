<?php

namespace App\Filament\Admin\Pages;

use App\Models\Cita;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
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
            ->query(Cita::query())
            ->modifyQueryUsing(fn(Builder $query) => $query->asignados())
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
                                TextInput::make('peso')
                                    ->numeric()
                                    ->suffix('.gr'),
                                TextInput::make('talla')
                                    ->numeric()
                                    ->suffix('m'),
                                TextInput::make('presion_arterial')
                                    ->numeric()
                                    ->suffix('nose'),
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
