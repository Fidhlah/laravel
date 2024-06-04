<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Car;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('id_customer')
                    ->required()
                    ->numeric(),
                Select::make('id_car')
                    ->required()
                    ->options(Car::pluck('nama', 'id')->toArray()) // Mengambil nama mobil dari model Car
                    ->searchable() // Membuat opsi dapat dicari
                    ->label('Nama Mobil'), // Menambahkan label untuk input
                Forms\Components\TextInput::make('id_driver')
                    ->numeric(),
                Forms\Components\TimePicker::make('pickup_time')
                ->required(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_penalty')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('booking_stat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Customer') // Menambahkan label untuk kolom
                    ->sortable(),
                Tables\Columns\TextColumn::make('car.nama') // Mengubah 'id_car' menjadi 'car.nama'
                    ->label('Nama Mobil') // Menambahkan label untuk kolom
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver.nama')
                    ->label('Nama Driver') // Menambahkan label untuk kolom
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_time'),
                    // ->format('H:i') // Format waktu tanpa tanggal (jam:menit)
                    // ->searchable(), // Membuat kolom ini dapat dicari
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_penalty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking_stat'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
