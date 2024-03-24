<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers;
use App\Models\Delivery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('from_first_line_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_second_line_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_state')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_postcode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('from_latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('from_longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('to_first_line_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_second_line_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_state')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_postcode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('to_longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('delivery_person_id')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('accepted_at')
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivered_at')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('from_first_line_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_second_line_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_postcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('from_longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_first_line_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_second_line_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_postcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to_latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_person_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('accepted_at')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivered_at')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
