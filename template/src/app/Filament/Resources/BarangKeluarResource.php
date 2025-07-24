<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangKeluarResource\Pages;
use App\Models\BarangKeluar;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BarangKeluarResource extends Resource
{
    protected static ?string $model = BarangKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?string $navigationLabel = 'Barang Keluar';
    protected static ?string $pluralLabel = 'Barang Keluar';
    protected static ?string $slug = 'barang-keluar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barang_id')
                    ->label('Nama Barang')
                    ->relationship('barang', 'nama_barang')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('jumlah_keluar')
                    ->label('Jumlah Keluar')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_keluar')
                    ->label('Tanggal Keluar')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_keluar')
                    ->label('Jumlah')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_keluar')
                    ->label('Tanggal Keluar')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangKeluars::route('/'),
            'create' => Pages\CreateBarangKeluar::route('/create'),
            'edit' => Pages\EditBarangKeluar::route('/{record}/edit'),
        ];
    }
}
