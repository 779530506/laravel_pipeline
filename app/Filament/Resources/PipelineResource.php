<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Hopital;
use App\Models\Pipeline;
use App\Models\Departement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Services\PipelineService;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\PipelineResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use App\Filament\Resources\PipelineResource\RelationManagers;
use Filament\Tables\Actions\DeleteAction as TableDeleteAction;
use Filament\Notifications\Actions\Action as NotificationAction;
use App\Filament\Resources\PipelineResource\Widgets\StatsOverview;

class PipelineResource extends Resource
{
    protected static ?string $model = Pipeline::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name_pipeline';

    protected static ?string $navigationGroup = 'System management';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->columns(2)
                ->schema([
                    TextInput::make('name_pipeline')
                        ->required()
                        ->label('Nom de pipeline')
                        ->rules([
                            function (Closure $get) {
                                return function (string $attribute, $value, Closure  $fail) use ($get) {
                                    $departement_id = (int) $get('departement_id');
                                    $hopital_id = (int) $get('hopital_id');
                                    $pipelines = Pipeline::where('departement_id',$departement_id)->pluck('name_pipeline');
                                    foreach($pipelines as $pipeline){
                                        if ($pipeline == $value) {
                                            $fail("Ce pipelines existe dans ce département ");
                                        }
                                    }

                                    $response = PipelineService::createPipeline($hopital_id,$departement_id,$value);
                                    if ($response["code"] != 201) {
                                            $fail("Erreur de création pipelines, verifier le serveur  ");
                                            Notification::make()
                                                ->title('Erreur!')
                                                ->danger()
                                                ->body('Impossible de créer ce pipeline, vérifier le serveur et les données saisies')
                                                ->persistent()
                                                ->send();
                                    }else{
                                        Notification::make()
                                        ->title('Success!')
                                        ->success()
                                        ->body($response["message"])
                                        ->persistent()
                                        ->send();
                                    }
                                };
                            },
                        ])
                        ->translateLabel(),
                    Select::make('user_id')
                        ->relationship('user', 'name'),
                    Select::make('hopital_id')
                        ->required()
                        ->label('Hopital')
                        ->options(Hopital::all()->pluck('name','id')->toArray())
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('departement_id',null)),
                    Select::make('departement_id')
                        ->label('Departement')
                        ->required()
                        ->options(function (callable $get){
                            $hopital = Hopital::find($get('hopital_id'));
                            if(!$hopital){
                                return Departement::all()-> pluck('name','id');
                            }
                            return $hopital->departements->pluck('name','id');
                        }),
                    Toggle::make('is_running'),

                 ])
                ]);


            }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name_pipeline')
            ->searchable()
            ->label('Nom Pipeline ')
            ->translateLabel(),
            BadgeColumn::make('departement.name')
            ->color('tertiary')
            ->label('Departement'),

            BadgeColumn::make('hopital.name')
            ->color('tertiary')
            ->label('Hopital'),
            IconColumn::make('is_running')
                ->boolean(),



           ])
            ->filters([
                Filter::make('is_running')
                    ->query(fn (Builder $query): Builder => $query->where('is_running', true)),
                Filter::make('is_not_running')
                    ->query(fn (Builder $query): Builder => $query->where('is_running', false)),
                SelectFilter::make('user')->relationship('user', 'name')

            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                TableDeleteAction::make()
                ->before(function (TableDeleteAction $action,Pipeline $record) {
                    $response = PipelineService::deletePipeline($record);

                   if ( $response['code']!=204) {
                        Notification::make()
                            ->warning()
                            ->title('Error de suppression pipeline')
                            ->body('Verier si ce pipeline existe')
                            ->persistent()
                            // ->actions([
                            //     NotificationAction::make('subscribe')
                            //         ->button()
                            //         ->url(route('filament.pages.dashboard'), shouldOpenInNewTab: true),
                            // ])
                            ->send();

                         $action->halt();
                    }
                }),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPipelines::route('/'),
            'create' => Pages\CreatePipeline::route('/create'),
            'edit' => Pages\EditPipeline::route('/{record}/edit'),
            'view' => Pages\ViewPipeline::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }


}
