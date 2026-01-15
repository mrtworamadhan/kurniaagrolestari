<?php

namespace App\Filament\Pages;

use App\Filament\Exports\InventoryExporter;
use App\Filament\Exports\OrderExporter;
use App\Models\Product;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use BackedEnum;

class InventoryReport extends Page implements HasTable
{
    use HasPageShield;
    use InteractsWithTable;

    protected string $view = 'filament.pages.inventory-report';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string | UnitEnum | null $navigationGroup = 'Laporan';

    protected static ?string $title = 'Laporan Stok & Aset';

    protected static ?int $navigationSort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Foto'),
                
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stok Fisik')
                    ->sortable()
                    ->color(fn ($state) => $state < 10 ? 'danger' : 'success') 
                    ->icon(fn ($state) => $state < 10 ? 'heroicon-m-exclamation-triangle' : null),

                TextColumn::make('price_retail')
                    ->label('Harga Retail')
                    ->money('IDR'),

                TextColumn::make('price_agent')
                    ->label('Harga Agent')
                    ->money('IDR'),

                TextColumn::make('price_distributor')
                    ->label('Harga Distributor')
                    ->money('IDR'),

                TextColumn::make('asset_value')
                    ->label('Estimasi Aset')
                    ->state(fn (Product $record) => $record->stock * $record->price_distributor)
                    ->money('IDR')
                    ->sortable(),
            ])
            ->defaultSort('stock', 'asc') 
            ->filters([
                Filter::make('low_stock')
                    ->label('Stok Menipis (< 10)')
                    ->query(fn ($query) => $query->where('stock', '<', 10)),
                
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(InventoryExporter::class)
                    ->label('Download Data Stok')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('warning') 
                    ->fileName(fn () => 'Laporan-Stok-' . date('Y-m-d')),
            ]);
    }

}
