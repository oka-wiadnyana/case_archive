<?php

namespace App\Filament\Resources\FileReturnResource\Pages;

use App\Filament\Resources\FileReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFileReturn extends EditRecord
{
    protected static string $resource = FileReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
