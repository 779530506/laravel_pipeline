<?php

namespace App\Filament\Resources;

use Closure;

use App\Filament\Resources\PredictionResource\Pages;
use App\Filament\Resources\PredictionResource\RelationManagers;
use App\Models\Prediction;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Services\PredictionService;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions\CreateAction;

use Illuminate\Database\Eloquent\SoftDeletingScope;

class PredictionResource extends Resource
{
    protected static ?string $model = Prediction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'System management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('pipeline_id')
                    ->relationship('Pipeline', 'name_pipeline'),
                Forms\Components\TextInput::make('thickness')
                        ->integer(),
                Forms\Components\TextInput::make('size')
                        ->integer(),
                        Forms\Components\TextInput::make('shape')
                        ->integer(),
                Forms\Components\TextInput::make('madh')
                        ->integer(),
                        Forms\Components\TextInput::make('epsize')
                        ->integer(),
                Forms\Components\TextInput::make('bnuc')
                        ->integer(),
                Forms\Components\TextInput::make('nNuc')
                        ->integer(),
                Forms\Components\TextInput::make('bchrom')
                        ->integer(),
                Forms\Components\TextInput::make('mit')
                        ->integer()
                        // ->rules([
                        //     PredictionService::createPrediction()
                        //     ])
                        // ->rules([
                        //     function () {
                        //         return function (string $attribute, $value, Closure $fail) {
                        //             PredictionService::createPrediction();
                        //             if ($value === 'foo') {
                        //                 $fail("The {$attribute} is invalid.");
                        //             }
                        //         };
                        //     },
                        // ]),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->translateLabel(),
                BadgeColumn::make('result')
                ->color('tertiary')
            ])
            ->filters([
                //
            ])
            ->actions([
              //  Tables\Actions\EditAction::make(),


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
            'index' => Pages\ListPredictions::route('/'),
            // 'create' => Pages\CreatePrediction::route('/create'),
            'edit' => Pages\EditPrediction::route('/{record}/edit'),
        ];
    }
}
