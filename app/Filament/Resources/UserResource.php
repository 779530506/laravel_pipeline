<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Livewire\Livewire;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\PipelinesRelationManager;
use App\Services\PipelineService;
use Filament\Forms\Components\CheckboxList;
use Closure;
use Filament\Notifications\Notification;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'User management';

    protected static ?string $recordTitleAttribute = 'name';

    //protected static bool $shouldRegisterNavigation = false;

    public static $icon = 'heroicon-o-user';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Username')
                        ->rules([
                            function (Closure $get) {
                                return function (string $attribute, $value, Closure  $fail) use ($get) {
                                    $password =  $get('password');
                                    $email =  $get('email');
                                    $response=PipelineService::createUser($value,$password,$email);
                                    if ($response["code"] != 201) {
                                            $fail("Erreur de création User, verifier le serveur  ");
                                            Notification::make()
                                                ->title('Erreur!')
                                                ->danger()
                                                ->body('Impossible de créer ce user, vérifier le serveur et les données saisies')
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
                        ->maxLength(150)
                        ->translateLabel(),
                    TextInput::make('password')
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord  )
                        ->password()
                        ->label('Password')
                        ->rules(['string'])
                        ->minLength(8)
                        ->dehydrated(fn ($state)=> filled($state))
                        ->dehydrateStateUsing(fn ($state)=> Hash::make($state))
                        ->translateLabel(),
                    // TextInput::make('password_confirmation')
                    //     ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                    //     ->password()
                    //     ->rules(['string'])
                    //     ->label('Password Confirmation')
                    //     ->maxLength(150)
                    //     ->translateLabel()
                    //     ->dehydrated(false),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->disabled(fn ($context) => $context === 'edit')
                        ->unique(table: User::class, column: 'email', ignoreRecord: true)
                        ->label('Email')
                        ->unique(ignoreRecord: true)
                        ->translateLabel(),
                    CheckboxList::make('roles')
                    ->relationship('roles','name')
                    ->columns(3)

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
                TextColumn::make('roles.name')


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

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasAnyRole(['Super Admin', 'admin' ]);
    }

}
