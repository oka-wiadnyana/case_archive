<?php

namespace App\Filament\Resources\ArchivePidanaResource\Pages;

use App\Filament\Resources\ArchivePidanaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchivePidanas extends ListRecords
{
    protected static string $resource = ArchivePidanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
