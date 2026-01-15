<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Models\Order;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Riwayat Pembayaran';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('payment_date')
                    ->label('Tanggal Bayar')
                    ->default(now())
                    ->required(),

                TextInput::make('amount')
                    ->label('Jumlah Bayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('payment_method')
                    ->label('Metode')
                    ->options([
                        'Transfer BCA' => 'Transfer BCA',
                        'Transfer Mandiri' => 'Transfer Mandiri',
                        'Cash' => 'Tunai',
                    ])
                    ->required(),

                FileUpload::make('proof_image')
                    ->label('Bukti Transfer')
                    ->image()
                    ->directory('payments'),

                Select::make('status')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Diterima / Sah',
                        'rejected' => 'Ditolak',
                    ])
                    ->default('verified')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title:amount')
            ->columns([
                TextColumn::make('payment_date')->date(),
                TextColumn::make('amount')->money('IDR'),
                TextColumn::make('payment_method'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                    }),
                ImageColumn::make('proof_image')->label('Bukti'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Pembayaran')
                    ->after(function ($livewire) {
                        self::updateOrderPaymentStatus($livewire->getOwnerRecord());
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(function ($livewire) {
                        self::updateOrderPaymentStatus($livewire->getOwnerRecord());
                    }),
                DeleteAction::make()
                    ->after(function ($livewire) {
                        self::updateOrderPaymentStatus($livewire->getOwnerRecord());
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function updateOrderPaymentStatus(Order $order)
    {
        $totalPaid = $order->payments()->where('status', 'verified')->sum('amount');
        
        $order->paid_amount = $totalPaid;

        if ($totalPaid >= $order->total_amount) {
            $order->payment_status = 'paid';
        } elseif ($totalPaid > 0) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'unpaid';
        }

        $order->save();
    }
}
