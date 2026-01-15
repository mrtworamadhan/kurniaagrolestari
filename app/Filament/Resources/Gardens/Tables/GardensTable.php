<?php

namespace App\Filament\Resources\Gardens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GardensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Kebun')
                    ->searchable(),

                TextColumn::make('plant_type')
                    ->label('Tanaman')
                    ->badge()
                    ->color('success'),

                TextColumn::make('soil_type')
                    ->label('Tanah')
                    ->badge()
                    ->color('warning'), 

                TextColumn::make('area_size')
                    ->label('Luas')
                    ->suffix(' Ha')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('plant_type')
                    ->options(['Sawit' => 'Sawit', 'Karet' => 'Karet']),
                SelectFilter::make('soil_type')
                    ->options(['Gambut' => 'Gambut', 'Mineral' => 'Mineral']),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
