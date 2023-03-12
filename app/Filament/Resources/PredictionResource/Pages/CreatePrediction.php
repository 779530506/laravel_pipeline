<?php

namespace App\Filament\Resources\PredictionResource\Pages;

use App\Filament\Resources\PredictionResource;
use App\Models\Prediction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrediction extends CreateRecord
{
    protected static string $resource = PredictionResource::class;

    protected function afterCreate(Prediction $pre): void
    {
        // Runs after the form fields are saved to the database.
    }
}
