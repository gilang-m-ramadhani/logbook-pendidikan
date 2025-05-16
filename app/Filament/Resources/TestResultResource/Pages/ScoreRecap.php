<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use App\Filament\Resources\TestResultResource;
use Filament\Resources\Pages\Page;

class ScoreRecap extends Page
{
    protected static string $resource = TestResultResource::class;

    protected static string $view = 'filament.resources.test-result-resource.pages.score-recap';
}
