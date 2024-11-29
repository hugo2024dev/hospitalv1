<?php

namespace App\Enums\Diagnostico;

use Filament\Support\Contracts\HasLabel;

enum TipoDiagnosticoEnum: string implements HasLabel
{
    case PRESUNTIVO = 'Presuntivo';
    case DEFINITIVO = 'Definitivo';
    case REPETIDO = 'Repetido';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return array_column(
            array_map(fn($case) => ['value' => $case->value, 'label' => $case->getLabel()], self::cases()),
            'label',
            'value'
        );
    }
}
