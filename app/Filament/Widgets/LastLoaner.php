<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\LoanResource;
use App\Models\FileLoan;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use stdClass;

class LastLoaner extends BaseWidget
{
    protected static ?int $sort=3;
    protected array|string|int $columnSpan='full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LoanResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('loan_date','desc')
            
            ->columns([
                TextColumn::make('Nomor')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * (
                                $livewire?->paginators['page'] - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('loan_date'),
                TextColumn::make('nomor_perkara')->getStateUsing(
                    function (FileLoan $fileLoan) {
                     return $fileLoan->perkara?->nomor_perkara;
                    }
                ),
                TextColumn::make('Peminjam')->getStateUsing(
                    function (FileLoan $fileLoan) {
                     return $fileLoan->loaner?->name;
                    }
                ),
                TextColumn::make('Status')
                ->badge()
                ->color(function (FileLoan $fileLoan) {
                    return $fileLoan->fileReturn?->return_date?'success':'warning';
                   })
                ->getStateUsing(
                    function (FileLoan $fileLoan) {
                     return $fileLoan->fileReturn?->return_date?'Dikembalikan':'Belum Dikembalikan';
                    }
                ),
              
            ]);
    }
}
