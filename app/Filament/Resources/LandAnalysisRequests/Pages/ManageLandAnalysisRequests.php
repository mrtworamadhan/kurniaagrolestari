<?php

namespace App\Filament\Resources\LandAnalysisRequests\Pages;

use App\Filament\Resources\LandAnalysisRequests\LandAnalysisRequestResource;
use App\Models\LandAnalysisRequest;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageLandAnalysisRequests extends ManageRecords
{
    protected static string $resource = LandAnalysisRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [

            'pending' => Tab::make('Pending')
                ->icon('heroicon-m-pencil-square')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(
                    LandAnalysisRequest::where('status', 'pending')->count()
                )
                ->badgeColor('warning'),
            
            'converted' => Tab::make('Sudah di Proses')
                ->icon('heroicon-m-arrow-right-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'converted'))
                ->badge(
                    LandAnalysisRequest::where('status', 'converted')->count()
                )
                ->badgeColor('success'),

            
            'all' => Tab::make('Semua')
                ->icon('heroicon-m-list-bullet'),

        ];
    }
}
