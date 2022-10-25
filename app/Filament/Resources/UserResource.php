<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\PipelinesRelationManager;
use App\Models\User;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';


    public static $icon = 'heroicon-o-user';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Prenom')
                        ->rule('alpha_dash')
                        ->maxLength(150)
                        ->translateLabel(),
                    TextInput::make('password')
                        ->required()
                        ->label('Password')
                        ->rules(['string'])
                        ->maxLength(150)
                        ->translateLabel(),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->disabled(fn ($context) => $context === 'edit')
                        ->unique(table: User::class, column: 'email', ignoreRecord: true)
                        ->label('Email')
                        ->unique(ignoreRecord: true)
                        ->translateLabel()
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
                    ->label('Nom Complet')
                    ->translateLabel(),
                TextColumn::make('email')
                    ->searchable()
                    ->translateLabel(),


            ])
            ->filters([
                //
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
            PipelinesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
