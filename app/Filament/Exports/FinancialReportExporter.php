<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class FinancialReportExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('created_at')
                ->label('Tanggal Transaksi'),

            ExportColumn::make('invoice_number')
                ->label('No Invoice'),

            ExportColumn::make('user.name')
                ->label('Pelanggan'),

            ExportColumn::make('payment_status')
                ->label('Status Bayar'),

            ExportColumn::make('total_amount')
                ->label('Total Tagihan (Omzet)'),

            ExportColumn::make('paid_amount')
                ->label('Sudah Dibayar (Cash In)'),

            ExportColumn::make('sisa_tagihan')
                ->label('Sisa Tagihan (Piutang)')
                ->state(function (Order $record): float {
                    return $record->total_amount - $record->paid_amount;
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your financial report export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
