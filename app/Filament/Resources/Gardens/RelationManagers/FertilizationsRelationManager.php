<?php

namespace App\Filament\Resources\Gardens\RelationManagers;

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
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FertilizationsRelationManager extends RelationManager
{
    protected static string $relationship = 'fertilizations';

    protected static ?string $title = 'Riwayat Pemupukan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('fertilization_date')
                    ->label('Tanggal Aplikasi')
                    ->required()
                    ->default(now()),
                
                TextInput::make('fertilizer_name')
                    ->label('Nama Pupuk')
                    ->required()
                    ->placeholder('Contoh: NPK 16-16-16')
                    ->maxLength(255),

                Grid::make(2)->schema([
                    TextInput::make('dosage')
                        ->label('Dosis')
                        ->numeric()
                        ->step(0.01)
                        ->required(),
                    
                    Select::make('unit')
                        ->label('Satuan')
                        ->options([
                            'Kg/Pokok' => 'Kg/Pokok',
                            'Gr/Pokok' => 'Gr/Pokok',
                            'Karung' => 'Karung (Total)',
                            'Liter' => 'Liter',
                        ])
                        ->default('Kg/Pokok')
                        ->required(),
                ]),

                Textarea::make('notes')
                    ->label('Catatan Lapangan')
                    ->rows(2)
                    ->columnSpanFull(),

                FileUpload::make('photo_evidence')
                    ->label('Foto Bukti')
                    ->image()
                    ->directory('fertilization-evidence')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fertilizer_name')
            ->columns([
                TextColumn::make('fertilization_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                TextColumn::make('fertilizer_name')
                    ->label('Jenis Pupuk')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('dosage_full')
                    ->label('Dosis')
                    ->state(fn ($record) => $record->dosage . ' ' . $record->unit),

                ImageColumn::make('photo_evidence')
                    ->label('Bukti')
                    ->circular(),
            ])
            ->defaultSort('fertilization_date', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label('Catat Pemupukan'),
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
