<?php

namespace App\Filament\Admin\Resources\EspecialidadResource\Pages;

use App\Filament\Admin\Resources\EspecialidadResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEspecialidads extends ManageRecords
{
    protected static string $resource = EspecialidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
