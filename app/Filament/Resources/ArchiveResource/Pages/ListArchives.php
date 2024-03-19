<?php

namespace App\Filament\Resources\ArchiveResource\Pages;

use App\Filament\Resources\ArchiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListArchives extends ListRecords
{

    protected static string $resource = ArchiveResource::class;
    protected static ?string $title = 'Daftar Arsip';

    // public static function getEloquentQuery(): Builder
    // {
    //     $kind=ArchiveResource::getUrl();
    //     return static::getModel()::query()->where('is_admin', 1);
    // }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
