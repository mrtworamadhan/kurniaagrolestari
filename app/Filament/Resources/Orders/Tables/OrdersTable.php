<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->label('No. Invoice')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->description(fn (Order $record) => ucfirst($record->user->customer_group))
                    ->searchable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR'),

                SelectColumn::make('status')
                    ->label('Status Order')
                    ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Konfirmasi',
                            'processing' => 'Diproses',
                            'shipping' => 'Dikirim',
                            'completed' => 'Selesai',
                            'cancelled' => 'Batal',
                        ])
                    ->selectablePlaceholder(false)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unpaid' => 'danger',
                        'partial' => 'warning',
                        'paid' => 'success',
                    }),

                TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status'),
                SelectFilter::make('payment_status'),
            ])
            ->recordActions([
                EditAction::make()->label(''),
                Action::make('print')
                    ->label('Cetak Invoice')
                    ->color('info')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Order $record) => route('invoice.print', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
