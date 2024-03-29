<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArchiveResource\Pages;
use App\Filament\Resources\ArchiveResource\RelationManagers;
use App\Filament\Resources\Columns\CustomColumn;
use App\Models\AlurPerkara;
use App\Models\Archive;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use stdClass;
use Illuminate\Support\Str;

class ArchiveResource extends Resource
{
    protected static ?string $model = Archive::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Arsip Perdata';
    protected static ?string $navigationGroup = 'Arsip';
    
   

    public function customIndex($parameter)
    {
        dd($parameter);
        // Use $parameter here as needed
        // You can fetch data or perform other operations based on this parameter
        
        // Return a response, render a view, or redirect as needed
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    


    public static function getEloquentQuery(): Builder
    {
       
        return static::getModel()::query()->whereHas('klasifikasi',function($q){
            $q->whereIn('alur_perkara_id',[1,2,7,8]);
        });
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
                TextColumn::make('nomor_perkara')->searchable(),
                TextColumn::make('klasifikasi.pihak1_text')
                ->getStateUsing(function(Archive $archive){
                    $nama=Str::of($archive->klasifikasi->pihak1_text)->explode('<br />')->implode(', ');
                    return $nama;
                })
                ->label('Penggugat')
                ->wrap()
                ->searchable(),
                TextColumn::make('klasifikasi.pihak2_text')
                ->getStateUsing(function(Archive $archive){
                    $nama=Str::of($archive->klasifikasi->pihak2_text)->explode('<br />')->implode(', ');
                    return $nama;
                })
                ->label('Tergugat')
                ->wrap()
                ->searchable(),
                TextColumn::make('jenisPerkara.nama')->getStateUsing(
                   function (Archive $archive) {
                    return $archive->jenisPerkara?->nama??"Nomor tidak sesuai";
                   }
                )->badge()
                ->color(function (Archive $archive) {
                    return in_array($archive->jenisPerkara?->id,[1,2,7,8])?"success":(in_array($archive->jenisPerkara?->id,[111,112,114,118,113])?'danger':'warning');
                   }),
                TextColumn::make('klasifikasi.jenis_perkara_nama')->getStateUsing(
                    function (Archive $archive) {
                     return $archive->klasifikasi->jenis_perkara_nama??"Nomor tidak sesuai";
                    }
                 )->searchable(),
                TextColumn::make('tanggal_masuk_arsip')->getStateUsing(function(Archive $archive){
                    return Carbon::parse($archive->tanggal_masuk_arsip)->format('d-m-Y');
                })->searchable(),
                TextColumn::make('nama_penyerah'),
                TextColumn::make('nama_penerima'),
                TextColumn::make('no_ruang')->getStateUsing(function(Archive $archive){
                    return "No Ruang : ".$archive->no_ruang.", No Lemari : ".$archive->no_lemari.", No Rak : ".$archive->no_rak.", No Berkas : ".$archive->no_berkas.", No Arsip : ".$archive->nomor_arsip;
                })->searchable(),
              

            ])->defaultSort('tanggal_masuk_arsip', 'desc')
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])->recordUrl(null);
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
            'index' => Pages\ListArchives::route('/'),
            'create' => Pages\CreateArchive::route('/create'),
            'edit' => Pages\EditArchive::route('/{record}/edit'),
        ];
    }
}
