<?php

use App\Filament\Resources\ArchiveResource;
use App\Livewire\UserList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', UserList::class);

Route::get('/archives/{parameter}', [ArchiveResource::class, 'customIndex']);
