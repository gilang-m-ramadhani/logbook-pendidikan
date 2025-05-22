<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultResource\Pages;
use App\Filament\Resources\TestResultResource\RelationManagers;
use App\Models\TestResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('test_id')
                ->relationship('test', 'judul')
                ->label('Test')
                ->required()
                ->native(false),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Peserta')
                ->searchable()
                ->required()
                ->native(false),
            Forms\Components\Select::make('dosen_id')
                ->relationship('dosen', 'name')
                ->label('Dosen')
                ->searchable()
                ->required()
                ->native(false),
            Forms\Components\TextInput::make('nilai')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),
            Forms\Components\RichEditor::make('feedback')
                ->columnSpanFull(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('test.judul')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Mahasiswa')
                ->searchable(),
            Tables\Columns\TextColumn::make('dosen.name')
                ->label('Dosen')
                ->searchable(),
            Tables\Columns\TextColumn::make('nilai')
                ->sortable()
                ->color(fn (int $state): string => match (true) {
                    $state >= 80 => 'success',
                    $state >= 60 => 'warning',
                    default => 'danger',
                }),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('test')
                ->relationship('test', 'judul')
                ->multiple()
                ->searchable(),
            Tables\Filters\SelectFilter::make('user')
                ->relationship('user', 'name')
                ->searchable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestResults::route('/'),
            'create' => Pages\CreateTestResult::route('/create'),
            'view' => Pages\ViewTestResult::route('/{record}'),
            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
