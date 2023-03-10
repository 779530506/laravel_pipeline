<?php

namespace App\Filament\Resources\PredictionResource\Pages;

use App\Filament\Resources\PredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPredictions extends ListRecords
{
    protected static string $resource = PredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
