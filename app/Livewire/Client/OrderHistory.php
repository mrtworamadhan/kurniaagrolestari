<?php

namespace App\Livewire\Client;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Riwayat Pesanan')]
#[Layout('components.layouts.client')]
class OrderHistory extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('livewire.client.order-history', [
            'orders' => $orders
        ]);
    }
}