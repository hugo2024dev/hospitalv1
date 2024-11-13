<?php

namespace App\Filament\Admin\Resources\ProgramacionResource\Pages;

use App\Filament\Admin\Resources\ProgramacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramacion extends EditRecord
{
    protected static string $resource = ProgramacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
