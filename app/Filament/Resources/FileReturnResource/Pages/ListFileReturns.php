<?php

namespace App\Filament\Resources\FileReturnResource\Pages;

use App\Filament\Resources\FileReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;


class ListFileReturns extends ListRecords
{
    protected static string $resource = FileReturnResource::class;
    protected static ?string $title = 'Berkas belum kembali';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    
    
}
