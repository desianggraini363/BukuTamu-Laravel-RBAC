<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestbookResource\Pages;
use App\Models\Guestbook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuestbookResource extends Resource
{
    protected static ?string $model = Guestbook::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    // Hilangkan menu dari sidebar
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('nama_tamu')
                    ->label('Nama Tamu')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('keperluan')
                    ->label('Keperluan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('pesan')
                    ->label('Pesan')
                    ->rows(4),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('nama_tamu')
                    ->label('Nama Tamu')
                    ->searchable(),

                Tables\Columns\TextColumn::make('keperluan')
                    ->label('Keperluan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('pesan')
                    ->label('Pesan')
                    ->limit(40),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Kunjungan')
                    ->dateTime('d M Y H:i'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuestbooks::route('/'),
            'create' => Pages\CreateGuestbook::route('/create'),
            'edit' => Pages\EditGuestbook::route('/{record}/edit'),
        ];
    }
}