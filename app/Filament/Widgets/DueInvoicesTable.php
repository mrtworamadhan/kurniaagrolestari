<?php

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class DueInvoicesTable extends TableWidget
{
    use HasWidgetShield;
    protected static ?string $heading = '⚠️ Tagihan Jatuh Tempo (Segera Hubungi)';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->where('payment_method', 'tempo')
                    ->whereIn('payment_status', ['unpaid', 'partial'])
                    ->where('due_date', '<=', now()->addDays(7))
                    ->orderBy('due_date', 'asc')
            )
            ->columns([
                    TextColumn::make('due_date')
                        ->label('Jatuh Tempo')
                        ->date()
                        ->sortable()
                        ->color(fn($record) => $record->due_date < now() ? 'danger' : 'warning')
                        ->description(fn($record) => $record->due_date->diffForHumans()),

                    TextColumn::make('invoice_number')->label('Invoice'),
                    TextColumn::make('user.name')->label('Pelanggan'),

                    TextColumn::make('sisa_tagihan')
                        ->label('Sisa Hutang')
                        ->state(fn(Order $record) => $record->total_amount - $record->paid_amount)
                        ->money('IDR')
                        ->weight('bold'),
                ])
            ->filters([
                    //
                ])
            ->headerActions([
                    //
                ])
            ->recordActions([
                    Action::make('whatsapp')
                        ->label('Nagih WA')
                        ->icon('heroicon-m-chat-bubble-left-ellipsis')
                        ->color('success')
                        ->button()
                        ->url(function (Order $record) {
                            $phone = $record->user->phone;
                            if (substr($phone, 0, 1) == '0') {
                                $phone = '62' . substr($phone, 1);
                            }

                            $sisa = number_format($record->total_amount - $record->paid_amount, 0, ',', '.');
                            $tgl = $record->due_date->format('d M Y');

                            $text = "Halo {$record->user->name}, kami dari PT Pupuk Maju Jaya mengingatkan Invoice *{$record->invoice_number}* senilai *Rp {$sisa}* akan jatuh tempo pada *{$tgl}*. Mohon segera dilakukan pembayaran. Terima kasih.";

                            return "https://wa.me/{$phone}?text=" . urlencode($text);
                        })
                        ->openUrlInNewTab(),
                ])
            ->toolbarActions([
                    BulkActionGroup::make([
                        //
                    ]),
                ]);
    }
}
