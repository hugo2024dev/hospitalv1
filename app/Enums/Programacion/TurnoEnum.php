<?php

namespace App\Enums\Programacion;

use Filament\Support\Contracts\HasLabel;

enum TurnoEnum: string implements HasLabel
{
    case MAÑANA = 'Mañana';
    case TARDE = 'Tarde';

    public const DEFAULT = self::MAÑANA->value;

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
