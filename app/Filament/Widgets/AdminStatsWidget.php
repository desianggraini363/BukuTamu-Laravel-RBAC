<?php

namespace App\Filament\Widgets;

use App\Models\Guestbook;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Tamu Hari Ini',
                Guestbook::whereDate('created_at', today())->count()
            ),

            Stat::make(
                'Total Tamu Bulan Ini',
                Guestbook::whereMonth('created_at', now()->month)->count()
            ),

            Stat::make(
                'Total Tamu Tahun Ini',
                Guestbook::whereYear('created_at', now()->year)->count()
            ),

            Stat::make(
                'Total User Terdaftar',
                User::count()
            ),
        ];
    }
}