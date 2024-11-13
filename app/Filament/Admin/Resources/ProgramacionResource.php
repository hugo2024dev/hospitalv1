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

    protected static ?string $navigationIcon = 'tabler-calendar-event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cantidad_citas')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
                Forms\Components\TextInput::make('hora_inicio')
                    ->required(),
                Forms\Components\TextInput::make('hora_fin')
                    ->required(),
                Forms\Components\TextInput::make('empleado_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('consultorio_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('especialidad_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cantidad_citas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hora_inicio'),
                Tables\Columns\TextColumn::make('hora_fin'),
                Tables\Columns\TextColumn::make('empleado_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('consultorio_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('especialidad_id')
                    ->numeric()
                    ->sortable(),
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
