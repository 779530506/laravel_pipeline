<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PipelineResource\Pages;
use App\Filament\Resources\PipelineResource\RelationManagers;
use App\Filament\Resources\PipelineResource\Widgets\StatsOverview;
use App\Models\Pipeline;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PipelineResource extends Resource
{
    protected static ?string $model = Pipeline::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                    ->query(fn (Builder $query): Builder => $query->where('is_running', true)),
                Filter::make('is_not_running')
                    ->query(fn (Builder $query): Builder => $query->where('is_running', false)),
                SelectFilter::make('user')->relationship('user', 'name')

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
