<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\LogEntry;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
        Stat::make('Total Mahasiswa', User::role('mahasiswa')->count())
            ->icon('heroicon-o-user-group')
            ->color('primary'),
        Stat::make('Total Dosen', User::role('dosen')->count())
            ->icon('heroicon-o-academic-cap')
            ->color('secondary'),
        Stat::make('Logbook Hari Ini', LogEntry::whereDate('created_at', today())->count())
            ->icon('heroicon-o-clipboard-document-list'),
        Stat::make('Logbook Belum Valid', LogEntry::where('validasi', false)->count())
            ->icon('heroicon-o-exclamation-circle')
            ->color('danger'),
        ];
    }
}
