<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Produk')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                
                                Select::make('category')
                                    ->label('Kategori Utama')
                                    ->options([
                                        'Pembenah Tanah' => 'Pembenah Tanah',
                                        'Pupuk Majemuk' => 'Pupuk Majemuk',
                                        'Pupuk Tunggal' => 'Pupuk Tunggal',
                                        'Mikro & Hormon' => 'Mikro & Hormon',
                                    ])
                                    ->required()
                                    ->searchable(),

                                Select::make('soilTypes')
                                    ->label('Cocok untuk Tanah')
                                    ->relationship('soilTypes', 'name') 
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),

                                Select::make('benefits')
                                    ->label('Manfaat Utama')
                                    ->relationship('benefits', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')->required(),
                                    ]),

                                Textarea::make('short_description')
                                    ->label('Deskripsi Singkat')
                                    ->rows(2)
                                    ->maxLength(255),
                                
                                RichEditor::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Detail Teknis')
                            ->schema([
                                KeyValue::make('specifications')
                                    ->label('Spesifikasi (Unsur Hara)')
                                    ->keyLabel('Unsur (Misal: N)')
                                    ->valueLabel('Kadar (Misal: 16%)')
                                    ->addActionLabel('Tambah Unsur'),

                                Textarea::make('usage_instruction')
                                    ->label('Cara Aplikasi')
                                    ->rows(3),
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Media')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Foto Produk')
                                    ->image()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('products')
                                    ->required(),
                            ]),

                        Section::make('Harga & Stok')
                            ->schema([
                                TextInput::make('price_retail')
                                    ->label('Harga Retail (Umum)')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                                
                                TextInput::make('price_agent')
                                    ->label('Harga Agen')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),

                                TextInput::make('price_distributor')
                                    ->label('Harga Distributor')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('stock')
                                            ->label('Stok')
                                            ->numeric()
                                            ->default(0),
                                        
                                        TextInput::make('unit')
                                            ->label('Satuan')
                                            ->default('Sak')
                                            ->placeholder('Sak/Btl'),
                                    ]),
                            ]),

                        Section::make('Status')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Aktif / Dijual')
                                    ->default(true),
                            ]),
                    ])->columnSpan(1),
            ])
            ->columns(3);
    }
}
