<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EspecialidadResource\Pages;
use App\Filament\Admin\Resources\EspecialidadResource\RelationManagers;
use App\Models\Especialidad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EspecialidadResource extends Resource
{
    protected static ?string $model = Especialidad::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $pluralModelLabel = 'Especialidades';
    protected static ?string $navigationIcon = 'tabler-stars';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEspecialidads::route('/'),
        ];
    }
}
