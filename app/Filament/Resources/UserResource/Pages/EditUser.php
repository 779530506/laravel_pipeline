<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use App\Services\PipelineService;
use Filament\Pages\Actions\Action;
use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Delete to Serveur')
                ->action('run')
                ->color('success'),
            Actions\DeleteAction::make(),
        ];
    }

    public function run()
    {
        $response = PipelineService::deleteUser($this->record->name);

        if ($response) {
            if ($response['code']==1){
            Notification::make()
                ->success()
                ->title('Success')
                ->body($response["message"])
                ->send();
            }else{
                Notification::make()
                ->success()
                ->title('Success')
                ->body($response["message"])
                ->send();
            }

        }else{
            Notification::make()
                ->danger()
                ->title('dager')
                ->body('User not, Vérifier le serveur')
                ->send();
        }

        //dd($response);
        // $currentUrl = url('/admin/users/' );
        // return Redirect()->to($currentUrl);
    }
}
