<?php

namespace App\Filament\Resources\PredictionResource\Pages;

use App\Filament\Resources\PredictionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrediction extends EditRecord
{
    protected static string $resource = PredictionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
