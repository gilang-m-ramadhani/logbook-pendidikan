<?php

namespace App\Filament\Resources\MiniCEXResource\Pages;

use App\Filament\Resources\MiniCEXResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiniCEX extends EditRecord
{
    protected static string $resource = MiniCEXResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
