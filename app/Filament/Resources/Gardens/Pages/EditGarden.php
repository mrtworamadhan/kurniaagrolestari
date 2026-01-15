<?php

namespace App\Filament\Resources\Gardens\Pages;

use App\Filament\Resources\Gardens\GardenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGarden extends EditRecord
{
    protected static string $resource = GardenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
