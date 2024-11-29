<?php

namespace App\Filament\Admin\Resources\CitaResource\Pages;

use App\Filament\Admin\Resources\CitaResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCita extends EditRecord
{
    protected static string $resource = CitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    function form(Form $form): Form
    {
        return $form->schema([]);
    }
}
