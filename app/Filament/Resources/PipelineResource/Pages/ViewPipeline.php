<?php

namespace App\Filament\Resources\PipelineResource\Pages;

use App\Models\Pipeline;
use Filament\Pages\Actions;
use App\Services\PipelineService;
use Filament\Pages\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PipelineResource;

class ViewPipeline extends ViewRecord
{
    protected static string $resource = PipelineResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Run')
                ->action('run')
                ->color('success'),
               // ->icon('heroicon-s-download'),

             Action::make('Stop')
             ->action('stop')
             ->color('danger')
            // ->icon('heroicon-s-download'),
         // Actions\EditAction::make(),
        ];
    }

    public function run()
    {
        $response = PipelineService::runOrOffPipeline($this->record,'run');

        if ( $response['code']==200) {
            $this->record->update(['is_running' => true]);
            Notification::make()
                ->success()
                ->title('Success')
                ->body('pipeline running')
                ->send();

        }else{
            Notification::make()
                ->danger()
                ->title('dager')
                ->body('pipeline not running, Vérifier le serveur')
                ->send();
        }

        //dd($response);
        $currentUrl = url('/admin/pipelines/' . $this->record->id);
        return Redirect()->to($currentUrl);
    }

    public function stop()
    {
        $response = PipelineService::runOrOffPipeline($this->record,'stop');
        if ( $response['code']==200) {
            $this->record->update(['is_running' => false]);
            Notification::make()
                ->success()
                ->title('Success')
                ->body('pipeline stopped')
                ->send();

        }else{
            Notification::make()
                ->danger()
                ->title('dager')
                ->body('pipeline not stopped, Vérifier le serveur')
                ->send();
        }
        $currentUrl = url('/admin/pipelines/' . $this->record->id);
        return Redirect()->to($currentUrl);
    }

}
