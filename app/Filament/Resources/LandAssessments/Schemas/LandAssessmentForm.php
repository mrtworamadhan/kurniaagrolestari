<?php

namespace App\Filament\Resources\LandAssessments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LandAssessmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Status Assessment')
                    ->schema([
                        Select::make('garden_id')
                            ->relationship('garden', 'name')
                            ->label('Pilih Kebun')
                            ->searchable()
                            ->preload()
                            ->columnSpanFull()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending (Baru Masuk)',
                                'sample_received' => 'Sampel Tanah Diterima',
                                'lab_process' => 'Proses Lab',
                                'completed' => 'Selesai (Rekomendasi Terbit)',
                            ])
                            ->default('pending')
                            ->required()
                            ->columnSpanFull()
                            ->selectablePlaceholder(false),
                    ])->columns(2),
                
                Section::make('Dokumentasi Lapangan')
                    ->schema([
                        FileUpload::make('photos')
                            ->label('Foto Pohon/Daun/Tanah')
                            ->multiple() 
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('assessment-photos')
                            ->columnSpanFull(),
                        
                        TextInput::make('video_url')
                            ->label('Link Video (Google Drive/YouTube)')
                            ->suffixIcon('heroicon-m-video-camera'),
                    ]),

                Section::make('Data Historis (Dari Kuesioner)')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('plant_variety')->label('Jenis Bibit'),
                                TextInput::make('topography')->label('Kontur Lahan'),
                                TextInput::make('bunch_weight')->label('Berat Tandan (Kg)'),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextInput::make('current_yield')->label('Panen Saat Ini (Ton/Ha)'),
                                TextInput::make('target_yield')->label('Target Panen'),
                            ]),

                        Textarea::make('current_condition')
                            ->label('Kondisi Tanaman (Visual)')
                            ->rows(3),

                        Textarea::make('fertilizer_history')
                            ->label('Riwayat Pemupukan (6 Bulan Terakhir)')
                            ->rows(3),
                    ])->collapsible(),

                
            ]);
    }
}
