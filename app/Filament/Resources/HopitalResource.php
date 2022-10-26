<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HopitalResource\Pages;
use App\Filament\Resources\HopitalResource\RelationManagers;
use App\Filament\Resources\HopitalResource\RelationManagers\DepartementsRelationManager;
use App\Models\Hopital;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HopitalResource extends Resource
{
    protected static ?string $model = Hopital::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'System management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Nom Hopital')
                        ->unique()
                        ->maxLength(150)
                 ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                        ->sortable()
                        ->searchable()
                        ->label('Nom Hopital ')
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHopitals::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            DepartementsRelationManager::class
        ];
    }
}
