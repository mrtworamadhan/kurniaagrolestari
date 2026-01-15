<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class InventoryExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Nama Produk'),

            ExportColumn::make('unit')
                ->label('Satuan'),

            ExportColumn::make('stock')
                ->label('Sisa Stok Fisik'),

            ExportColumn::make('price_retail')
                ->label('Harga Retail'),

            ExportColumn::make('price_agent')
                ->label('Harga Agent'),

            ExportColumn::make('price_distributor')
                ->label('Harga Distributor'),

            ExportColumn::make('total_asset_value')
                ->label('Estimasi Nilai Aset')
                ->state(function (Product $record): float {
                    return $record->stock * $record->price_distributor;
                }),
                
            ExportColumn::make('is_active')
                ->label('Status Aktif')
                ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Non-Aktif'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your inventory export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
