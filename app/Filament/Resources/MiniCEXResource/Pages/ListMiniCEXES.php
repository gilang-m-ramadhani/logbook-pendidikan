<?php

namespace App\Filament\Resources\MiniCEXResource\Pages;

use App\Filament\Resources\MiniCEXResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiniCEXES extends ListRecords
{
    protected static string $resource = MiniCEXResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
