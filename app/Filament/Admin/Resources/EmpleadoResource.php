<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmpleadoResource\Pages;
use App\Filament\Admin\Resources\EmpleadoResource\RelationManagers;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $navigationIcon = 'tabler-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_documento')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nombres')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('apellido_paterno')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('apellido_materno')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                    ->required(),
                Forms\Components\TextInput::make('sexo')
                    ->required()
                    ->maxLength(1),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('tipo_documento_id')
                    ->relationship('tipoDocumento', 'nombre')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_documento')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_paterno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_materno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipoDocumento.nombre')
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
