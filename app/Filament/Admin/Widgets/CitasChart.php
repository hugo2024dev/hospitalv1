<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Cita;
use App\Models\Programacion;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
class CitasChart extends ChartWidget
{
    protected static ?string $heading = 'N° de atenciones por mes';
    protected static string $color = 'warning';
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = null;


    protected function getData(): array
    {
        $data = Trend::query(Cita::query()->join('programacions', 'programacions.id', '=', 'citas.programacion_id'))
            ->dateColumn('programacions.fecha')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count('citas.id');

        return [
            'datasets' => [
                [
                    'label' => 'Citas',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
