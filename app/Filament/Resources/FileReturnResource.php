<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileReturnResource\Pages;
use App\Filament\Resources\FileReturnResource\RelationManagers;
use App\Models\FileLoan;
use App\Models\FileReturn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable as ContractsHasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class FileReturnResource extends Resource
{
    protected static ?string $model = FileReturn::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Belum kembali';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                FileLoan::whereDoesntHave('fileReturn')
            )
            ->columns([
                TextColumn::make('Nomor')->getStateUsing(
                    static function (stdClass $rowLoop, ContractsHasTable $livewire): string {
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
            ])
            ->filters([
                //
            ])->recordUrl(null);
            // ->actions([
            //     // Tables\Actions\EditAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFileReturns::route('/'),
            'create' => Pages\CreateFileReturn::route('/create'),
            'edit' => Pages\EditFileReturn::route('/{record}/edit'),
        ];
    }
}
