<?php

namespace App\Filament\Resources\Gardens;

use App\Filament\Resources\Gardens\Pages\CreateGarden;
use App\Filament\Resources\Gardens\Pages\EditGarden;
use App\Filament\Resources\Gardens\Pages\ListGardens;
use App\Filament\Resources\Gardens\RelationManagers\FertilizationsRelationManager;
use App\Filament\Resources\Gardens\RelationManagers\HarvestsRelationManager;
use App\Filament\Resources\Gardens\RelationManagers\MonitoringsRelationManager;
use App\Filament\Resources\Gardens\Schemas\GardenForm;
use App\Filament\Resources\Gardens\Tables\GardensTable;
use App\Models\Garden;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GardenResource extends Resource
{
    protected static ?string $model = Garden::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string | UnitEnum | null $navigationGroup = 'Smart Farming';

    protected static ?string $navigationLabel = 'Data Kebun';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GardenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GardensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MonitoringsRelationManager::class,
            FertilizationsRelationManager::class,
            HarvestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGardens::route('/'),
            'create' => CreateGarden::route('/create'),
            'edit' => EditGarden::route('/{record}/edit'),
        ];
    }
}
