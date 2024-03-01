<?php

namespace App\Filament\Pages\Auth;

use App\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;
use Filament\Pages\Page;

class Registration extends Register
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                TextInput::make('username')
                ->label('Login')
                ->required()
                ->autocomplete()
                ->autofocus(),
            
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                Select::make('role_id')
                ->label('Role')
                ->required()
                ->options(Role::all()->pluck('role','id'))
                ,
               
            ]);
    }
}
