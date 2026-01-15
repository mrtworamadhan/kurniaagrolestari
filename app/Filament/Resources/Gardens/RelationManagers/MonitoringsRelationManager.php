<?php

namespace App\Filament\Resources\Gardens\RelationManagers;

use App\Models\User;
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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonitoringsRelationManager extends RelationManager
{
    protected static string $relationship = 'monitorings';

    protected static ?string $title = 'Rekam Perkembangan (Monitoring)';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('monitoring_date')
                    ->label('Tanggal Kunjungan')
                    ->default(now())
                    ->required(),
                
                Select::make('assessor_id')
                    ->label('Petugas Cek')
                    ->options(User::pluck('name', 'id')) 
                    ->default(auth()->id()),

                Section::make('Indikator Perubahan')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([

                            TextInput::make('current_yield')
                            ->label('Hasil Panen (Ton)')
                            ->suffix('Ton/Ha'),
                        
                            TextInput::make('fruit_weight')
                                ->label('Berat Janjang (BJR)')
                                ->suffix('kg'),

                            Textarea::make('visual_condition')
                                ->label('Kondisi Visual')
                                ->placeholder('Contoh: Daun mulai hijau, pelepah membuka...')
                                ->required()
                                ->columnSpanFull(),
                        
                        ])
                        
                    ]),

                FileUpload::make('photos')
                    ->label('Foto Dokumentasi')
                    ->image()
                    ->multiple() 
                    ->directory('monitoring-photos')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title:monitoring_date')
            ->columns([
                TextColumn::make('monitoring_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('visual_condition')
                    ->limit(50),
                TextColumn::make('current_yield')
                    ->label('Panen'),
                ImageColumn::make('photos')
                    ->circular()
                    ->stacked()
                    ->limit(3),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->label('Catat Hasil Monitoring'),
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
