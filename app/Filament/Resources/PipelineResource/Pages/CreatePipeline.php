<?php

namespace App\Filament\Resources\PipelineResource\Pages;

use App\Filament\Resources\PipelineResource;
use App\Models\Pipeline;
use App\Services\PipelineService;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePipeline extends CreateRecord
{
    protected static string $resource = PipelineResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $response = PipelineService::createPipeline();

        // if ($response["code"]==201){
        // $pipeline = Pipeline::create([
        //     'name_hospital' => $data['name_hospital'],
        //     'name_pipeline' => $data['name_pipeline'],
        //     'name_dep' => $data['name_dep'],
        // ]);

        //     return $data ;
        // }
        if ($response["code"] != 201) {

            Notification::make()
                ->title('Oups!')
                ->danger()
                ->body($response["message"])
                ->persistent()
                ->actions([
                    Action::make('OK')
                        ->url(route('filament.pages.dashboard'))
                        ->button()
                ])
                ->send();
            return $data;
        } else {
            Notification::make()
                ->title('Success!')
                ->danger()
                ->body($response["message"])
                ->persistent()
                ->actions([
                    Action::make('OK')
                        ->url(route('filament.pages.dashboard'))
                        ->button()
                ])
                ->send();
            return $data;
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
