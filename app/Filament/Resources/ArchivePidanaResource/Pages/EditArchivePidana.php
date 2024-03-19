<?php

namespace App\Filament\Resources\ArchivePidanaResource\Pages;

use App\Filament\Resources\ArchivePidanaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArchivePidana extends EditRecord
{
    protected static string $resource = ArchivePidanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
