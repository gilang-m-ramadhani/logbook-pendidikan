<?php

namespace App\Filament\Resources\MiniCEXResource\Pages;

use App\Filament\Resources\MiniCEXResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMiniCEX extends ViewRecord
{
    protected static string $resource = MiniCEXResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
