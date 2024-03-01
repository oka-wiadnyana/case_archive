<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Filament\Resources\LoanResource;
use App\Http\Controllers\PrintController;
use App\Models\Loaner;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\ListRecords;
use Livewire\Component;
use Illuminate\Support\Str;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;
    protected static ?string $title = 'Peminjaman berkas';
    

    protected function getHeaderActions(): array
    {
        $print=new PrintController();
        return [
            Actions\CreateAction::make(),
            Action::make('Dash')
            ->requiresConfirmation()
            ->action(function () use($print) {
                return $print->index();
            })
            
        ];
    }
}
