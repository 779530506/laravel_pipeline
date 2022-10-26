<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartementResource\Pages;
use App\Filament\Resources\DepartementResource\RelationManagers;
use App\Models\Departement;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartementResource extends Resource
{
    protected static ?string $model = Departement::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'System management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Nom departement')
                        ->rules([
                            function (Closure $get) {
                                return function (string $attribute, $value, Closure  $fail) use ($get) {
                                    $hopital_id = (int) $get('hopital_id');
                                    $departements = Departement::where('hopital_id',$hopital_id)->pluck('name');
                                    foreach($departements as $departement){
                                        if ($departement == $value) {
                                            $fail("Ce département existe dans cet hopital ");
                                        }
                                    }

                                };
                            },
                        ])
                        ->maxLength(150)
                        ->translateLabel(),
                    Select::make('hopital_id')
                        ->relationship('hopital', 'name'),

                 ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                        ->sortable()
                        ->searchable()
                        ->label('Nom Departement '),
                BadgeColumn::make('hopital.name')
                        ->label('Hopital'),
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
            'index' => Pages\ManageDepartements::route('/'),
        ];
    }
}
