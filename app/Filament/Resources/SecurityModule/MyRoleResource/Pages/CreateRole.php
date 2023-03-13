<?php
namespace App\Filament\Resources\SecurityModule\MyRoleResource\Pages;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\CreateRecord;
use BezhanSalleh\FilamentShield\Support\Utils;
use App\Filament\Resources\SecurityModule\MyRoleResource;

class CreateRole extends CreateRecord
{
    protected static string $resource = MyRoleResource::class;

    public Collection $permissions;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['guard_name'] = "web";

        $this->permissions = collect($data)->filter(function ($permission, $key) {
            return !in_array($key, ['name', 'guard_name', 'select_all']) && Str::contains($key, '_');
        })->keys();

        return Arr::only($data, ['name', 'guard_name']);
    }

    protected function afterCreate(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            ));
        });

        $this->record->syncPermissions($permissionModels);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Role **' . $this->record->name . '** ajouté avec succés';
    }
}
