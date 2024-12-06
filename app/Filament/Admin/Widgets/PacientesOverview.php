<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Empleado;
use App\Models\Especialidad;
use App\Models\Paciente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PacientesOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('N° Pacientes', Paciente::count())
                ->description('Registros en total')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('N° Medicos', Empleado::count())
                ->description('Registros en total')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('N° Especialidades', Especialidad::count())
                ->description('Registros en total')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
