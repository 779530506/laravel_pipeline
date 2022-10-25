<?php

namespace App\Filament\Resources\PipelineResource\Widgets;

use App\Models\Pipeline;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Nombre de pipeline', Pipeline::all()->count() ),
            Card::make('Pipeline running', Pipeline::all()->where("is_running",true)->count() ),
            Card::make('Pipeline not running', Pipeline::all()->where("is_running",false)->count() ),
        ];
    }
}
