<?php

namespace App\Filament\Resources\ArchiveResource\Pages;

use App\Filament\Resources\ArchiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchives extends ListRecords
{

    protected static string $resource = ArchiveResource::class;
    protected static ?string $title = 'Daftar Arsip';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
