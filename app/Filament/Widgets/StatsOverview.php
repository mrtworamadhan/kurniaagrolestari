<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        $omzetThisMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                            ->sum('total_amount');
                            
        $omzetLastMonth = Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                            ->sum('total_amount');

        $diff = $omzetThisMonth - $omzetLastMonth;
        $icon = $diff >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $color = $diff >= 0 ? 'success' : 'danger';
        $desc = $diff >= 0 ? 'Naik dibanding bulan lalu' : 'Turun dibanding bulan lalu';

        $piutang = Order::whereIn('payment_status', ['unpaid', 'partial'])
                        ->where('payment_method', 'tempo')
                        ->sum(\DB::raw('total_amount - paid_amount'));

        $newOrders = Order::where('status', 'pending')->count();

        return [
            Stat::make('Total Omzet Bulan Ini', 'Rp ' . number_format($omzetThisMonth, 0, ',', '.'))
                ->description($desc)
                ->descriptionIcon($icon)
                ->color($color)
                ->chart([$omzetLastMonth, $omzetThisMonth]),

            Stat::make('Total Piutang (Tempo)', 'Rp ' . number_format($piutang, 0, ',', '.'))
                ->description('Tagihan belum lunas')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),

            Stat::make('Order Baru (Pending)', $newOrders)
                ->description('Perlu diproses')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
        ];
    }
}