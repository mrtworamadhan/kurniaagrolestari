<?php

namespace App\Filament\Resources\SoilStandards\Pages;

use App\Filament\Resources\SoilStandards\SoilStandardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSoilStandards extends ManageRecords
{
    protected static string $resource = SoilStandardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
