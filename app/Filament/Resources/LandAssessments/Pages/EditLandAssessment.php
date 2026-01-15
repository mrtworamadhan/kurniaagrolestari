<?php

namespace App\Filament\Resources\LandAssessments\Pages;

use App\Filament\Resources\LandAssessments\LandAssessmentResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLandAssessment extends EditRecord
{
    protected static string $resource = LandAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('analyze')
                ->label('Buka Analisa')
                ->icon('heroicon-m-beaker')
                ->color('info')
                ->url(fn () => AnalyzeAssessment::getUrl(['record' => $this->getRecord()])),
            DeleteAction::make(),
        ];
    }
}
