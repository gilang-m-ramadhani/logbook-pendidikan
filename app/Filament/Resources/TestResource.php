<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Pages\ViewTest;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Informasi Test')
                ->schema([
                    Forms\Components\Select::make('jenis')
                        ->options([
                            'pre-test' => 'Pre-Test',
                            'post-test' => 'Post-Test',
                        ])
                        ->required()
                        ->native(false),
                    Forms\Components\TextInput::make('judul')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('deskripsi')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('acak_soal')
                        ->label('Acak Urutan Soal?')
                        ->default(true),
                    Forms\Components\Toggle::make('acak_pilihan')
                        ->label('Acak Urutan Pilihan Jawaban?')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Paket Soal')
                ->schema([
                    Forms\Components\Repeater::make('paket_soal')
                        ->label('')
                        ->schema([
                            Forms\Components\TextInput::make('nama_paket')
                                ->required()
                                ->columnSpanFull(),

                            Forms\Components\Repeater::make('soal')
                                ->label('Soal')
                                ->schema([
                                    Forms\Components\RichEditor::make('pertanyaan')
                                        ->required()
                                        ->columnSpanFull(),

                                    Forms\Components\Repeater::make('pilihan')
                                        ->label('Pilihan Jawaban')
                                        ->schema([
                                            Forms\Components\TextInput::make('text')
                                                ->required()
                                                ->label('Teks Jawaban'),
                                            Forms\Components\Toggle::make('benar')
                                                ->label('Jawaban Benar?')
                                                ->default(false),
                                        ])
                                        ->defaultItems(4)
                                        ->minItems(2)
                                        ->maxItems(5)
                                        ->grid(2),

                                    Forms\Components\TextInput::make('bobot')
                                        ->numeric()
                                        ->default(1)
                                        ->minValue(1)
                                        ->maxValue(10),
                                ])
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['pertanyaan'] ?? null)
                                ->columnSpanFull(),
                        ])
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['nama_paket'] ?? null)
                        ->columnSpanFull(),
                ]),
        ]);
}

protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['paket_soal'] = json_encode($data['paket_soal']);
    return $data;
}

protected function mutateFormDataBeforeFill(array $data): array
{
    $data['paket_soal'] = json_decode($data['paket_soal'], true);
    return $data;
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('judul')
                ->searchable(),
            Tables\Columns\TextColumn::make('jenis')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pre-test' => 'blue',
                    'post-test' => 'green',
                }),
            Tables\Columns\TextColumn::make('paket_soal_count')
                ->label('Jumlah Paket')
                ->getStateUsing(fn ($record) => count(json_decode($record->paket_soal, true))),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            // 'view' => Pages\ViewTest::route('/{record}'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
