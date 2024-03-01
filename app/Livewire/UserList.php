<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\User;

class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    

    public function table(Table $table): Table
    {
        return $table
        ->query(User::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                
            
            ]);
    }

    public function render()
    {
        return view('livewire.user-list');
    }

   
}
