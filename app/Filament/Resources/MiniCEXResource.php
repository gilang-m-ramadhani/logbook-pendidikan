<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MiniCEXResource\Pages;
use App\Filament\Resources\MiniCEXResource\RelationManagers;
use App\Models\MiniCEX;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MiniCEXResource extends Resource
{
    protected static ?string $model = MiniCEX::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('log_entry_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('dosen_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('penilaian')
                    ->required(),
                Forms\Components\TextInput::make('nilai_akhir')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_entry_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosen_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_akhir')
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMiniCEXES::route('/'),
            'create' => Pages\CreateMiniCEX::route('/create'),
            'view' => Pages\ViewMiniCEX::route('/{record}'),
            'edit' => Pages\EditMiniCEX::route('/{record}/edit'),
        ];
    }
}
