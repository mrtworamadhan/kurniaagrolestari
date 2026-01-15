<?php

namespace App\Filament\Resources\SoilStandards;

use App\Filament\Resources\SoilStandards\Pages\ManageSoilStandards;
use App\Models\SoilStandard;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SoilStandardResource extends Resource
{
    protected static ?string $model = SoilStandard::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Standar Hara (Agronomi)';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kategori Standar')
                    ->description('Tentukan standar ini berlaku untuk tanaman dan tanah apa.')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('plant_type')
                                ->label('Komoditas')
                                ->options([
                                    'Sawit' => 'Kelapa Sawit',
                                    'Karet' => 'Karet',
                                    'Hortikultura' => 'Hortikultura',
                                ])
                                ->required(),
                            
                            Select::make('soil_type_id')
                                ->label('Jenis Tanah')
                                ->relationship('soilType', 'name')
                                ->required()
                                ->createOptionForm([
                            TextInput::make('name')->required(),

                            ])
                        
                        ]),
                    ])->columnSpanFull(),
                
                Section::make('Nilai Standar Ideal')
                    ->description('Masukkan angka ideal. Gunakan titik (.) untuk desimal.')
                    ->columnSpanFull()
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('standard_values.ph_level')
                                    ->label('pH Tanah')
                                    ->numeric()->step(0.01)->required(),
                                
                                TextInput::make('standard_values.c_organic')
                                    ->label('C-Organik (%)')
                                    ->numeric()->step(0.01),
                                
                                TextInput::make('standard_values.ktk')
                                    ->label('KTK (cmol)')
                                    ->numeric()->step(0.01),
                            ])->columns(3),

                        Fieldset::make('Hara Makro')
                            ->schema([
                                TextInput::make('standard_values.n_total')
                                    ->label('N (%)')->numeric()->step(0.01),
                                TextInput::make('standard_values.p_available')
                                    ->label('P (ppm)')->numeric()->step(0.01),
                                TextInput::make('standard_values.k_exchange')
                                    ->label('K (cmol)')->numeric()->step(0.01),
                                TextInput::make('standard_values.mg_exchange')
                                    ->label('Mg (cmol)')->numeric()->step(0.01),
                                TextInput::make('standard_values.ca_exchange')
                                    ->label('Ca (cmol)')->numeric()->step(0.01),
                                TextInput::make('standard_values.s_sulfur')
                                    ->label('S (ppm)')->numeric()->step(0.01),
                            ])->columns(3),

                        Fieldset::make('Hara Mikro')
                            ->schema([
                                TextInput::make('standard_values.boron')
                                    ->label('Boron (ppm)')->numeric()->step(0.01),
                                TextInput::make('standard_values.zinc')
                                    ->label('Zinc (ppm)')->numeric()->step(0.01),
                                TextInput::make('standard_values.copper')
                                    ->label('Copper (ppm)')->numeric()->step(0.01),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('plant_type')
                    ->label('Tanaman')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('soilType.name')
                    ->label('Jenis Tanah')
                    ->badge()
                    ->color('warning')
                    ->sortable(),

                TextColumn::make('standard_values.ph_level')
                    ->label('Std pH'),
                
                TextColumn::make('standard_values.n_total')
                    ->label('Std N (%)'),

                TextColumn::make('updated_at')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('plant_type'),
                SelectFilter::make('soil_type_id')
                    ->relationship('soilType', 'name')
                    ->label('Jenis Tanah'),
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

    public static function getPages(): array
    {
        return [
            'index' => ManageSoilStandards::route('/'),
        ];
    }
}
