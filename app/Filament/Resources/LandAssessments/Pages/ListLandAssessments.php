<?php

namespace App\Filament\Resources\LandAssessments\Pages;

use App\Filament\Resources\LandAssessments\LandAssessmentResource;
use App\Models\LandAssessment;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLandAssessments extends ListRecords
{
    protected static string $resource = LandAssessmentResource::class;

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
                    LandAssessment::where('status', 'pending')->count()
                )
                ->badgeColor('danger'),
            
            'sample_received' => Tab::make('Sample di Terima')
                ->icon('heroicon-m-archive-box-arrow-down')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'sample_received'))
                ->badge(
                    LandAssessment::where('status', 'sample_received')->count()
                )
                ->badgeColor('warning'),

            'lab_process' => Tab::make('Uji Lab')
                ->icon('heroicon-m-beaker')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'lab_process'))
                ->badge(
                    LandAssessment::where('status', 'lab_process')->count()
                )
                ->badgeColor('info'),
            
            'completed' => Tab::make('Selesai')
                ->icon('heroicon-m-shield-check')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed'))
                ->badge(
                    LandAssessment::where('status', 'completed')->count()
                )
                ->badgeColor('success'),
            
            'all' => Tab::make('Semua')
                ->icon('heroicon-m-list-bullet'),

        ];
    }
}
