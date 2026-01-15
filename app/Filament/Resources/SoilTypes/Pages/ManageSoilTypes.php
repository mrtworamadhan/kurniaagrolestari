<?php

namespace App\Filament\Resources\SoilTypes\Pages;

use App\Filament\Resources\SoilTypes\SoilTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSoilTypes extends ManageRecords
{
    protected static string $resource = SoilTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
