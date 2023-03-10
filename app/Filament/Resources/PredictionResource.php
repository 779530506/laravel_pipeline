<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PredictionResource\Pages;
use App\Filament\Resources\PredictionResource\RelationManagers;
use App\Models\Prediction;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Database\Eloquent\Builder;
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
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->maxLength(150),

                 ])
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
            'create' => Pages\CreatePrediction::route('/create'),
            'edit' => Pages\EditPrediction::route('/{record}/edit'),
        ];
    }
}
