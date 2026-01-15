<?php

namespace App\Filament\Resources\LandAssessments\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BackedEnum;

class LabResultRelationManager extends RelationManager
{
    protected static string $relationship = 'labResult';

    protected static ?string $title = 'Hasil Laboratorium';
    protected static string|BackedEnum|null $Icon = Heroicon::OutlinedBeaker;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Paket Analisa')
                    ->schema([
                        Select::make('package_type')
                            ->label('Jenis Cek')
                            ->options([
                                'standard' => 'Standar (pH, C-Org, NPK, Mg, B)',
                                'complete' => 'Lengkap (+ Ca, S, Zn, Cu, KTK)',
                            ])
                            ->default('standard')
                            ->required()
                            ->live(),
                            
                        DatePicker::make('checked_at')
                            ->label('Tanggal Cek')
                            ->default(now())
                            ->required(),
                    ])->columns(1),

                Section::make('Sifat Kimia Tanah')
                    ->schema([
                        TextInput::make('ph_level')
                            ->label('pH Tanah')
                            ->numeric()->step(0.01)->required(),
                        
                        TextInput::make('c_organic')
                            ->label('C-Organik (%)')
                            ->numeric()->step(0.01),
                            
                        TextInput::make('ktk')
                            ->label('KTK (Cmol/kg)')
                            ->numeric()->step(0.01)
                            ->visible(fn (Get $get) => $get('package_type') === 'complete'),
                    ])->columns(3),

                Section::make('Hara Makro (Primer & Sekunder)')
                    ->schema([
                        TextInput::make('n_total')->label('N-Total (%)')->numeric()->step(0.01),
                        TextInput::make('p_available')->label('P-Tersedia (ppm)')->numeric()->step(0.01),
                        TextInput::make('k_exchange')->label('K-dd (Cmol/kg)')->numeric()->step(0.01),
                        TextInput::make('mg_exchange')->label('Mg-dd (Cmol/kg)')->numeric()->step(0.01),
                        
                        TextInput::make('ca_exchange')->label('Ca-dd')->numeric()->step(0.01)
                            ->visible(fn (Get $get) => $get('package_type') === 'complete'),
                        TextInput::make('s_sulfur')->label('Sulfur (ppm)')->numeric()->step(0.01)
                            ->visible(fn (Get $get) => $get('package_type') === 'complete'),
                    ])->columns(2),

                Section::make('Hara Mikro')
                    ->schema([
                        TextInput::make('boron')->label('Boron (ppm)')->numeric()->step(0.01),
                        
                        TextInput::make('zinc')->label('Seng / Zn (ppm)')->numeric()->step(0.01)
                            ->visible(fn (Get $get) => $get('package_type') === 'complete'),
                        TextInput::make('copper')->label('Tembaga / Cu (ppm)')->numeric()->step(0.01)
                            ->visible(fn (Get $get) => $get('package_type') === 'complete'),
                    ])->columns(2),

                Textarea::make('lab_notes')
                    ->label('Catatan Analisa Lab')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('package_type') 
            ->columns([
                TextColumn::make('package_type')
                    ->label('Paket')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'complete' ? 'success' : 'info')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                
                TextColumn::make('ph_level')
                    ->label('pH')
                    ->weight('bold'),
                
                TextColumn::make('n_total')->label('N (%)'),
                TextColumn::make('p_available')->label('P (ppm)'),
                TextColumn::make('k_exchange')->label('K (cmol)'),
                
                TextColumn::make('checked_at')->date()->label('Tgl Cek'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Input Hasil Lab Baru')
                    ->visible(fn ($livewire) => $livewire->getOwnerRecord()->labResult === null),
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
