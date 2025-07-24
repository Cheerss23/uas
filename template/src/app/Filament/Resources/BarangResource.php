<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Barang';
    protected static ?string $navigationGroup = 'Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('kode_barang')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                Forms\Components\TextInput::make('kategori')
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->required()
                    ->default(0),

                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kode_barang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stok')
                    ->sortable()
                    ->alignRight(),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable()
                    ->alignRight(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->label('Dibuat'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options(
                        Barang::query()->pluck('kategori', 'kategori')->unique()->toArray()
                    )
                    ->label('Filter Kategori'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
