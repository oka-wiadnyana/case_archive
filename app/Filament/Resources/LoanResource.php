<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Filament\Resources\LoanResource\RelationManagers\ReturnRelationManager;
use App\Models\FileLoan;
use App\Models\Loan;
use App\Models\Loaner;
use App\Models\Perkara;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use stdClass;

class LoanResource extends Resource
{
    protected static ?string $model = FileLoan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = 'Peminjaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('loan_date')->label('Tanggal pinjam')->native(false)->displayFormat('d/m/Y')->required(),
                Select::make('loaner_id')->label('Peminjam')->options(Loaner::all()->pluck('name','id')->toArray())->required(),
                Select::make('case_id')
                    // ->label('Nomor Perkara')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search): array => Perkara::where('nomor_perkara', 'like', "%{$search}%")->limit(10)->pluck('nomor_perkara', 'nomor_perkara')->toArray())
                    ->getOptionLabelUsing(function ($value): ?string {
                       
                        return $value;
                    })->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                TextColumn::make('loan_date')->searchable(),
                TextColumn::make('case_id')->searchable(),
                TextColumn::make('loaner.name')->getStateUsing(
                    function (FileLoan $fileLoan) {
                     return $fileLoan->loaner?->name;
                    }
                )->searchable(),
                TextColumn::make('fileReturn.return_date')
                ->badge()
                ->color(function (FileLoan $fileLoan) {
                    return $fileLoan->fileReturn?->return_date?'success':'warning';
                   })
                ->getStateUsing(
                    function (FileLoan $fileLoan) {
                     return $fileLoan->fileReturn?->return_date?'Dikembalikan':'Belum Dikembalikan';
                    }
                ),
              
    
              
                 
            ])->defaultSort('loan_date','desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReturnRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}
