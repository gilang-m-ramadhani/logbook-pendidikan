<?php

namespace App\Filament\Resources\LogEntryResource\Pages;

use App\Filament\Resources\LogEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLogEntry extends ViewRecord
{
    protected static string $resource = LogEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
