<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\Paciente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class PacienteTipoOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Gato', Paciente::query()->where('tipo', 'gato')->count()),
            Stat::make('Perro', Paciente::query()->where('tipo', 'perro')->count()),
            Stat::make('Conejo', Paciente::query()->where('tipo', 'conejo')->count()),

            Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Bounce rate', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
