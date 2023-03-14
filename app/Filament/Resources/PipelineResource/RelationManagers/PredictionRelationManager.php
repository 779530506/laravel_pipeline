<?php

namespace App\Filament\Resources\PipelineResource\RelationManagers;
use Closure;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Services\PredictionService;
use Filament\Forms\Components\Card;



class PredictionRelationManager extends RelationManager
{
    protected static string $relationship = 'predictions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
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
                        ->rules([
                            function () {
                                return function (string $attribute, $value, Closure $fail) {
                                    PredictionService::createPrediction();
                                    if ($value === 'foo') {
                                        $fail("The {$attribute} is invalid.");
                                    }
                                };
                            },
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('result'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                 Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
