<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PipelinesRelationManager extends RelationManager
{
    protected static string $relationship = 'pipelines';

    protected static ?string $recordTitleAttribute = 'name_pipeline';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name_hospital')
                        ->label('Nom de l\'hopital')
                        ->maxLength(150)
                        ->translateLabel(),
                    TextInput::make('name_dep')
                        ->required()
                        ->label('Nom Departement')
                        ->rules(['string'])
                        ->maxLength(150)
                        ->translateLabel(),
                    TextInput::make('name_pipeline')
                        ->required()
                        ->label('Nom de pipeline')
                        ->translateLabel(),
                    Select::make('user_id')
                        ->relationship('user', 'name'),
                    Toggle::make('is_running'),
                 ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name_hospital')
                ->sortable()
                ->searchable()
                ->label('Nom Hopital ')
                ->translateLabel(),
            TextColumn::make('name_dep')
                ->searchable()
                ->label('Nom Département ')
                ->translateLabel(),
            TextColumn::make('name_pipeline')
                ->searchable()
                ->label('Nom Pipeline ')
                ->translateLabel(),
            IconColumn::make('is_running')
                ->boolean()
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle')

            ])
            ->filters([
                Filter::make('is_running')
                    ->query(fn (Builder $query): Builder => $query->where('is_running', true))
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


}
