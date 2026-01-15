<?php

namespace App\Filament\Resources\LandAssessments\Tables;

use App\Filament\Resources\LandAssessments\Pages\AnalyzeAssessment;
use App\Models\LandAssessment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LandAssessmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('garden.name')
                    ->label('Kebun')
                    ->description(fn (LandAssessment $record) => $record->garden->user->name ?? '-') // Nama Pemilik di bawah nama kebun
                    ->searchable(),

                SelectColumn::make('status')
                    ->label('Status Order')
                    ->options([
                                'pending' => 'Pending (Baru Masuk)',
                                'sample_received' => 'Sampel Tanah Diterima',
                                'lab_process' => 'Proses Lab',
                                'completed' => 'Selesai (Rekomendasi Terbit)',
                            ])
                    ->selectablePlaceholder(false)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('current_condition')
                    ->label('Kondisi')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label('Tgl Masuk')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'sample_received' => 'Sampel Diterima',
                        'lab_process' => 'Proses Lab',
                        'completed' => 'Selesai',
                    ]),
            ])
            ->recordActions([
                Action::make('analyze')
                    ->label('Analisa')
                    ->icon('heroicon-m-beaker')
                    ->color('info') 
                    ->button()                    
                    ->url(fn (LandAssessment $record) => AnalyzeAssessment::getUrl(['record' => $record])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
