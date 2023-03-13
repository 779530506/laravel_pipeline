<?php
namespace App\Filament\Resources\SecurityModule\MyRoleResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SecurityModule\MyRoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = MyRoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
