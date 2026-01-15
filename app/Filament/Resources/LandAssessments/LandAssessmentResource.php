<?php

namespace App\Filament\Resources\LandAssessments;

use App\Filament\Resources\LandAssessments\Pages\AnalyzeAssessment;
use App\Filament\Resources\LandAssessments\Pages\CreateLandAssessment;
use App\Filament\Resources\LandAssessments\Pages\EditLandAssessment;
use App\Filament\Resources\LandAssessments\Pages\ListLandAssessments;
use App\Filament\Resources\LandAssessments\Schemas\LandAssessmentForm;
use App\Filament\Resources\LandAssessments\Tables\LandAssessmentsTable;
use App\Models\LandAssessment;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LandAssessmentResource extends Resource
{
    protected static ?string $model = LandAssessment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string | UnitEnum | null $navigationGroup = 'Smart Farming';

    protected static ?string $navigationLabel = 'Assessment & Lab';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', ['pending'])->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Perlu di Analisa';
    }

    public static function form(Schema $schema): Schema
    {
        return LandAssessmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LandAssessmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LabResultRelationManager::class,
            RelationManagers\RecommendationRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLandAssessments::route('/'),
            'create' => CreateLandAssessment::route('/create'),
            'edit' => EditLandAssessment::route('/{record}/edit'),
            'analyze' => AnalyzeAssessment::route('/{record}/analyze'),
        ];
    }
}
