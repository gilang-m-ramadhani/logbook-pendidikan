<?php

namespace App\Filament\Resources\LogEntryResource\Pages;

use App\Filament\Resources\LogEntryResource;
use Filament\Resources\Pages\Page;

class DailyReport extends Page
{
    protected static string $resource = LogEntryResource::class;

    protected static string $view = 'filament.resources.log-entry-resource.pages.daily-report';
}
