<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Departement;
use App\Models\Hopital;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
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
                    TextInput::make('name_pipeline')
                        ->required()
                        ->label('Nom de pipeline')
                        ->translateLabel(),
                    Select::make('user_id')
                        ->relationship('user', 'name'),
                        Select::make('hopital_id')
                        ->label('Hopital')
                        ->options(Hopital::all()->pluck('name','id')->toArray())
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('departement_id',null)),
                    Select::make('departement_id')
                        ->label('Departement')
                        ->options(function (callable $get){
                            $hopital = Hopital::find($get('hopital_id'));
                            if(!$hopital){
                                return Departement::all()-> pluck('name','id');
                            }
                            return $hopital->departements->pluck('name','id');
                        })
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('hopital_id',null)),
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
