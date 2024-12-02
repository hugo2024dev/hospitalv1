<?php

namespace App\Enums\Setting;

use Filament\Support\Contracts\HasLabel;

enum ReportType: string implements HasLabel
{
    case ORDEN_MEDICA = 'orden-medica-rayosx-pdf';

    public function getLabel(): ?string
    {
        return (string) ucwords($this->name);
    }
}
