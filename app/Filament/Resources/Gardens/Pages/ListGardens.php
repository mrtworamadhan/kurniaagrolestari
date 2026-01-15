<?php

namespace App\Filament\Resources\Gardens\Pages;

use App\Filament\Resources\Gardens\GardenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGardens extends ListRecords
{
    protected static string $resource = GardenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
