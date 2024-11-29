<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CitaResource\Pages;
use App\Filament\Admin\Resources\CitaResource\RelationManagers;
use App\Models\Cita;
use App\States\Cita\Asignado;
use App\States\Cita\Nuevo;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitaResource extends Resource
{
    protected static ?string $model = Cita::class;
    protected static ?string $modelLabel = 'Atenciones de consulta externa';
    protected static ?string $pluralModelLabel = 'Atenciones de consulta externa';

    protected static ?string $navigationIcon = 'tabler-brand-google-fit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_orden')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('hora_inicio')
                    ->required(),
                Forms\Components\TextInput::make('hora_fin')
                    ->required(),
                Forms\Components\TextInput::make('programacion_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('estado')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('paciente_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('user_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->asignados())
            ->columns([
                Tables\Columns\TextColumn::make('numero_orden')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora_inicio'),
                Tables\Columns\TextColumn::make('hora_fin'),
                // Tables\Columns\TextColumn::make('programacion_id')
                //     ->numeric()
                //     ->sortable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCitas::route('/'),
            'create' => Pages\CreateCita::route('/create'),
            'edit' => Pages\EditCita::route('/{record}/edit'),
        ];
    }
}
