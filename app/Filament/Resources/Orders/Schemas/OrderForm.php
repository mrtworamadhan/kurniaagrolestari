<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        $updateTotals = function (Get $get, Set $set) {
            $items = $get('items'); 
            
            if (!$items) {
                $set('total_amount', 0);
                return;
            }

            $total = 0;

            foreach ($items as $item) {
                $qty = intval($item['quantity'] ?? 0);
                $price = floatval($item['price'] ?? 0);
                $subtotal = $qty * $price;
                
                $total += $subtotal;
            }

            $set('total_amount', $total);
        };

        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Pelanggan')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Pelanggan')
                                    ->relationship(
                                            name: 'user',
                                            titleAttribute: 'name',
                                            modifyQueryUsing: fn ($query) => $query->where('role', 'client')
                                        )
                                    ->searchable()
                                    ->preload()
                                    ->live() 
                                    ->required()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('items', []);
                                        $set('total_amount', 0);
                                    }),

                                DatePicker::make('created_at')
                                    ->label('Tanggal Transaksi')
                                    ->default(now())
                                    ->required(),

                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pending (Menunggu)',
                                        'confirmed' => 'Konfirmasi',
                                        'processing' => 'Diproses / Dikemas',
                                        'shipping' => 'Dikirim',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Batal',
                                    ])
                                    ->default('pending')
                                    ->required(),
                                
                                Select::make('payment_method')
                                    ->options([
                                        'cash' => 'Cash / Tunai',
                                        'transfer' => 'Transfer Bank',
                                        'tempo' => 'Tempo / Kredit',
                                    ])
                                    ->live()
                                    ->required(),

                                DatePicker::make('due_date')
                                    ->label('Jatuh Tempo')
                                    ->visible(fn (Get $get) => $get('payment_method') === 'tempo')
                                    ->required(fn (Get $get) => $get('payment_method') === 'tempo'),
                            ])->columns(2),

                        Section::make('Daftar Barang')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')
                                            ->label('Produk')
                                            ->options(Product::where('is_active', true)->pluck('name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) use ($updateTotals) {
                                                $userId = $get('../../user_id');
                                                
                                                if ($state && $userId) {
                                                    $user = User::find($userId);
                                                    $product = Product::find($state);
                                                    $price = $product->getPriceForUser($user->customer_group ?? 'retail');
                                                    
                                                    $set('price', $price);
                                                    
                                                    $qty = $get('quantity') ?? 1;
                                                    $set('subtotal', $price * $qty);

                                                    $updateTotals($get, $set);
                                                }
                                            })
                                            ->columnSpan(4),

                                        TextInput::make('price')
                                            ->label('Harga Satuan')
                                            ->numeric()
                                            ->readOnly() 
                                            ->prefix('Rp')
                                            ->columnSpan(3),

                                        TextInput::make('quantity')
                                            ->label('Qty')
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1)
                                            ->live(onBlur: true) 
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) use ($updateTotals) {
                                                $price = $get('price') ?? 0;
                                                $subtotal = $state * $price;
                                                $set('subtotal', $subtotal);

                                                $updateTotals($get, $set);
                                            })
                                            ->columnSpan(2),

                                        TextInput::make('subtotal')
                                            ->label('Subtotal')
                                            ->numeric()
                                            ->readOnly()
                                            ->prefix('Rp')
                                            ->columnSpan(3),
                                    ])
                                    ->columns(12)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set) use ($updateTotals) {
                                        $updateTotals($get, $set);
                                    }),
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Ringkasan')
                            ->schema([
                                TextInput::make('total_amount')
                                    ->label('Total Tagihan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->live()
                                    ->readOnly(),

                                TextInput::make('discount_amount')
                                    ->label('Diskon')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->live(onBlur: true),

                                Placeholder::make('sisa_tagihan')
                                    ->label('Sisa Tagihan (Unpaid)')
                                    ->content(fn ($record) => $record ? 'Rp ' . number_format($record->total_amount - $record->paid_amount, 0, ',', '.') : '-'),
                                
                                Select::make('payment_status')
                                    ->options([
                                        'unpaid' => 'Belum Lunas',
                                        'partial' => 'Cicilan / Sebagian',
                                        'paid' => 'Lunas',
                                    ])
                                    ->default('unpaid')
                                    ->disabled(), 
                            ]),
                        
                        Textarea::make('notes')
                            ->label('Catatan Transaksi')
                            ->rows(3),
                    ])->columnSpan(1),
            ])
            ->columns(3);
    }
}
