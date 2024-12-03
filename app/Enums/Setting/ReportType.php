<?php

namespace App\Enums\Setting;

use Filament\Support\Contracts\HasLabel;

enum ReportType: string implements HasLabel
{
    case RAYOSX = 'orden-medica-rayosx-pdf';
    case ECOGRAFIA = 'orden-medica-ecografia-pdf';
    case EXAMEN = 'orden-medica-examen-pdf';
    case RECETA = 'receta-pdf';

    public function getLabel(): ?string
    {
        return (string) ucwords($this->name);
    }
}
