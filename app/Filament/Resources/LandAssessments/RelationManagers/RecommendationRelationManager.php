<?php

namespace App\Filament\Resources\LandAssessments\RelationManagers;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class RecommendationRelationManager extends RelationManager
{
    protected static string $relationship = 'recommendation';
    
    protected static ?string $title = 'Rekomendasi Pupuk';

    protected static string|BackedEnum|null $Icon = Heroicon::OutlinedSparkles;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Kesimpulan Agronom')
                    ->schema([
                        RichEditor::make('summary')
                            ->label('Diagnosa & Kesimpulan')
                            ->placeholder('Contoh: Tanah kekurangan unsur Hara Makro K dan pH terlalu rendah...')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                Section::make('Resep Pemupukan')
                    ->schema([
                        Repeater::make('product_recommendations')
                            ->label('Daftar Produk')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Pilih Produk')
                                    ->options(Product::where('is_active', true)->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(4), 
                                
                                TextInput::make('dosage')
                                    ->label('Dosis Per Pohon')
                                    ->placeholder('2 Kg')
                                    ->required()
                                    ->columnSpan(4),

                                TextInput::make('frequency')
                                    ->label('Frekuensi / Waktu')
                                    ->placeholder('2x setahun (Awal & Akhir Musim Hujan)')
                                    ->required()
                                    ->columnSpan(4),
                            ])
                            ->columns(12)
                            ->addActionLabel('Tambah Produk Lain'),
                    ])->columnSpanFull(),

                Section::make('Catatan Tambahan')
                    ->schema([
                        RichEditor::make('application_notes')
                            ->label('Instruksi Aplikasi Khusus')
                            ->placeholder('Contoh: Tabur merata di piringan berjarak 1.5m dari batang...')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title:summary')
            ->columns([
                TextColumn::make('summary')
                    ->label('Kesimpulan')
                    ->limit(50),
                
                TextColumn::make('product_recommendations')
                    ->label('Jml Produk')
                    ->formatStateUsing(fn ($state) => count($state ?? []) . ' Item'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->date(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Buat Rekomendasi')
                    ->visible(fn ($livewire) => $livewire->getOwnerRecord()->recommendation === null),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
