<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProgramacionResource\Pages;
use App\Filament\Admin\Resources\ProgramacionResource\RelationManagers;
use App\Models\Programacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramacionResource extends Resource
{
    protected static ?string $model = Programacion::class;
    protected static ?string $pluralModelLabel = 'Programaciones';
    // protected static ?string $navigationParentItem = 'testing';
    protected static ?string $navigationGroup = 'Mantenimiento';

    protected static ?string $navigationIcon = 'tabler-calendar-event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\DatePicker::make('fecha')
                //     ->unique(ignoreRecord: true)
                //     ->minDate(fn(string $operation, ?Programacion $programacion) => $operation === 'create' ? now()->startOfDay() : $programacion->fecha->startOfDay())
                //     ->required(),
                // Forms\Components\TimePicker::make('hora_inicio')
                //     ->required(),
                // Forms\Components\TimePicker::make('hora_fin')
                //     ->required(),
                Forms\Components\Select::make('empleado_id')
                    ->relationship('empleado', 'nombres')
                    ->required(),
                Forms\Components\Select::make('consultorio_id')
                    ->relationship('consultorio', 'nombre')
                    ->required(),
                Forms\Components\Select::make('especialidad_id')
                    ->relationship('especialidad', 'nombre')
                    ->required(),
                Forms\Components\TextInput::make('cantidad_citas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('duracion_cita')
                    ->required()
                    ->numeric(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('empleado.nombres')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('consultorio.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('especialidad.nombre')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('nombre')
                //     ->wrap()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('cantidad_citas')
                    ->label('N° de citas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora_inicio')
                    ->toggleable(true),
                Tables\Columns\TextColumn::make('hora_fin')
                    ->toggleable(true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProgramacions::route('/'),
            'create' => Pages\CreateProgramacion::route('/create'),
            'edit' => Pages\EditProgramacion::route('/{record}/edit'),
        ];
    }
}
