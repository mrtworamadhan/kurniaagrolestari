<?php

namespace App\Livewire\Client;

use App\Models\Garden;
use App\Models\Order;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; 

#[Title('Dashboard - Client Area')]
#[Layout('components.layouts.client')]
class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        $gardens = Garden::where('user_id', $user->id)->latest()->get();
        $totalArea = $gardens->sum('area_size');

        $totalDebt = 0;
        try {
            $totalDebt = Order::where('user_id', $user->id)
                ->where('payment_method', 'tempo')
                ->whereIn('payment_status', ['unpaid', 'partial'])
                ->get()
                ->sum(fn($order) => $order->total_amount - ($order->paid_amount ?? 0));
        } catch (\Exception $e) { $totalDebt = 0; }

        if ($gardens->count() > 0) {
            $rawLocation = $gardens->first()->location; 
        } else {
            $rawLocation = null;
        }

        $searchLocation = $rawLocation ?: 'Pekanbaru';

        $cacheKey = 'weather_' . $user->id . '_' . Str::slug($searchLocation);

        $weather = Cache::remember($cacheKey, 60 * 60, function () use ($searchLocation) {
            
            $apiKey = env('OPENWEATHER_API_KEY');
            
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $searchLocation,
                'appid' => $apiKey,
                'units' => 'metric', 
                'lang' => 'id'       
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'temp' => round($data['main']['temp']),
                    'desc' => ucfirst($data['weather'][0]['description']),
                    'loc' => $data['name'],
                    'icon' => $data['weather'][0]['icon']
                ];
            }

            return [
                'temp' => 30, 
                'desc' => 'Cerah (Offline)',
                'loc' => $searchLocation,
                'icon' => '02d'
            ];
        });

        return view('livewire.client.dashboard', [
            'user' => $user,
            'gardens' => $gardens,
            'totalArea' => $totalArea,
            'totalDebt' => $totalDebt,
            'weather' => $weather,
            'nextSchedule' => '2 Hari Lagi',
        ]);
    }
}