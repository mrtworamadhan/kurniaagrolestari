<?php

namespace App\Filament\Resources\Gardens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GardenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kepemilikan')
                    ->schema([
                        Select::make('user_id')
                            ->relationship(
                                    name: 'user',
                                    titleAttribute: 'name',
                                    modifyQueryUsing: fn ($query) => $query->where('role', 'client')
                                )
                            ->label('Pemilik Kebun')
                            ->searchable()
                            ->preload()
                            ->required(),
                            
                        TextInput::make('name')
                            ->label('Nama Blok / Kebun')
                            ->placeholder('Contoh: Blok A (Belakang Rumah)')
                            ->required(),

                        TextInput::make('location')
                            ->label('Lokasi (Desa/Kecamatan)')
                            ->required(),
                            
                        TextInput::make('coordinates')
                            ->label('Koordinat Map (Opsional)')
                            ->placeholder('-6.200000, 106.816666'),
                    ])->columns(2),

                Section::make('Data Agronomi')
                    ->schema([
                        TextInput::make('area_size')
                            ->label('Luas Lahan (Ha)')
                            ->numeric()
                            ->required(),

                        TextInput::make('plant_age')
                            ->label('Usia Tanaman (Tahun)')
                            ->numeric()
                            ->required(),

                        Select::make('plant_type')
                            ->label('Jenis Tanaman')
                            ->options([
                                'Sawit' => 'Kelapa Sawit',
                                'Karet' => 'Karet',
                                'Hortikultura' => 'Hortikultura',
                            ])
                            ->required(),

                        Select::make('soil_type')
                            ->label('Jenis Tanah')
                            ->options([
                                'Gambut' => 'Gambut',
                                'Mineral' => 'Mineral (Tanah Keras)',
                                'Pasir' => 'Pasir',
                                'Lempung' => 'Lempung',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
