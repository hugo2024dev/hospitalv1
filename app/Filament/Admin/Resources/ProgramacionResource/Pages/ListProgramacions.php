<?php

namespace App\Filament\Admin\Resources\ProgramacionResource\Pages;

use App\Filament\Admin\Resources\ProgramacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramacions extends ListRecords
{
    protected static string $resource = ProgramacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
