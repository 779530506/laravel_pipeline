<?php

namespace App\Filament\Resources\HopitalResource\Pages;

use App\Filament\Resources\HopitalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHopitals extends ManageRecords
{
    protected static string $resource = HopitalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
