<?php
namespace App\Filament\Resources\SecurityModule\MyRoleResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\EditRecord;
use BezhanSalleh\FilamentShield\Support\Utils;
use App\Filament\Resources\SecurityModule\MyRoleResource;

class EditRole extends EditRecord
{
    protected static string $resource = MyRoleResource::class;

    public Collection $permissions;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['guard_name'] = "web";

        $this->permissions = collect($data)->filter(function ($permission, $key) {
            return !in_array($key, ['name', 'guard_name', 'select_all']) && Str::contains($key, '_');
        })->keys();

        return Arr::only($data, ['name', 'guard_name']);
    }

    protected function afterSave(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => $this->data['guard_name']]
            ));
        });

        $this->record->syncPermissions($permissionModels);
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Role **' . $this->record->name . '** modifié avec succés';
    }
}
