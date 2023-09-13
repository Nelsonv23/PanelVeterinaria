<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use App\Models\Propietario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('tipo')
                ->options([
                    'gato' => 'Gato',
                    'perro' => 'Perro',
                    'conejo' => 'Conejo'
                ])->required(),

                Forms\Components\DatePicker::make('fecha_nacimiento') 
                ->required()
                ->maxDate(now()),

                Forms\Components\Select::make('propietario_id')   
                ->relationship('propietario', 'nombre')
                ->searchable()
                ->preload()
                ->required()   
                ->createOptionForm([
                    Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('telefono')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                ])->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre')
                ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                ->sortable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                ->sortable(),
                Tables\Columns\TextColumn::make('propietario.nombre')
                ->searchable(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('tipo')
                ->label('Tipo')
                ->options([
                    'gato' => 'Gato',
                    'perro' => 'Perro',
                    'conejo' => 'Conejo'
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\TratamientosRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }    
}
