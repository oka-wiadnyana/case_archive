<?php

namespace App\Filament\Widgets;

use App\Models\Archive;
use App\Models\FileLoan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Arsip', Archive::count())
            ->description('Jumlah arsip')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('Peminjaman', FileLoan::count())
            ->description('Jumlah peminjaman')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([10, 15, 10, 3, 15, 4, 17])
            ->color('danger'),
            Stat::make('Belum kembali', FileLoan::whereDoesntHave('fileReturn')->count())
            ->description('Jumlah belum kembali')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([10, 15, 10, 3, 15, 4, 17])
            ->color('warning'),
        ];
    }
}
