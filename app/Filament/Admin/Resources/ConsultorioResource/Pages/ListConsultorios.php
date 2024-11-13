<?php

namespace App\Filament\Admin\Resources\ConsultorioResource\Pages;

use App\Filament\Admin\Resources\ConsultorioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultorios extends ListRecords
{
    protected static string $resource = ConsultorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
