<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft'))
                ->badge(
                    Article::where('status', 'draft')->count()
                )
                ->badgeColor('warning'),
            
            'confirmed' => Tab::make('Published')
                ->icon('heroicon-m-wifi')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'published'))
                ->badge(
                    Article::where('status', 'published')->count()
                )
                ->badgeColor('success'),

            
            'all' => Tab::make('Semua')
                ->icon('heroicon-m-list-bullet'),

        ];
    }
}
