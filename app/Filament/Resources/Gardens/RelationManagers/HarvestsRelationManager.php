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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HarvestsRelationManager extends RelationManager
{
    protected static string $relationship = 'harvests';

    protected static ?string $title = 'Riwayat Panen';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('harvest_date')
                    ->label('Tanggal Panen')
                    ->required()
                    ->default(now()),

                Grid::make(2)->schema([
                    TextInput::make('weight_kg')
                        ->label('Berat Total (Kg)')
                        ->numeric()
                        ->required()
                        ->suffix('Kg'),

                    TextInput::make('bunch_count')
                        ->label('Jumlah Janjang')
                        ->numeric()
                        ->suffix('Janjang'),
                ]),

                TextInput::make('price_per_kg')
                    ->label('Harga Jual (Opsional)')
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Harga per Kg saat panen (jika dijual)'),

                Textarea::make('notes')
                    ->label('Catatan Panen')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('harvest_date')
            ->columns([
                TextColumn::make('harvest_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('weight_kg')
                    ->label('Berat (Kg)')
                    ->numeric()
                    ->summarize(Sum::make()->label('Total')), 

                TextColumn::make('bunch_count')
                    ->label('Janjang')
                    ->numeric(),

                TextColumn::make('bjr')
                    ->label('BJR (Kg)')
                    ->state(function ($record) {
                        if ($record->bunch_count > 0) {
                            return round($record->weight_kg / $record->bunch_count, 2);
                        }
                        return '-';
                    })
                    ->badge()
                    ->color('info'),
            ])
            ->defaultSort('harvest_date', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label('Catat Hasil Panen'),
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
