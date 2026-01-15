<x-slot name="header">Riwayat Order</x-slot>
<div class="pb-24 pt-4">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('client.profile') }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="font-bold text-xl text-gray-900 dark:text-white">Pesanan Saya</h1>
    </div>

    <div class="flex gap-2 overflow-x-auto hide-scrollbar mb-6 pb-2">
        <button class="px-4 py-1.5 rounded-full text-xs font-bold bg-primary-600 text-white shadow-md shadow-primary-500/30 whitespace-nowrap">
            Semua
        </button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 whitespace-nowrap">
            Belum Bayar
        </button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 whitespace-nowrap">
            Diproses
        </button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 whitespace-nowrap">
            Selesai
        </button>
    </div>

    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 relative overflow-hidden">
            
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center text-primary-600 dark:text-primary-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                        <h3 class="font-bold text-gray-900 dark:text-white text-sm">INV-{{ $order->invoice_number ?? str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                    </div>
                </div>

                @php
                    $statusClass = match($order->status) {
                        'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                        'processing' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                        'shipping' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
                        'completed' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                        'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                        default => 'bg-gray-100 text-gray-700'
                    };
                    $statusLabel = match($order->status) {
                        'pending' => 'Menunggu Bayar',
                        'processing' => 'Diproses',
                        'shipping' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $order->status
                    };
                @endphp
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>

            <div class="h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>

            <div class="flex justify-between items-end">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Tagihan</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">
                        Metode: <span class="font-semibold text-gray-600 dark:text-gray-300 uppercase">{{ $order->payment_method ?? 'Transfer' }}</span>
                    </p>
                </div>

                @if($order->status == 'pending' || $order->payment_status == 'unpaid')
                    <button class="bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold py-2.5 px-5 rounded-xl shadow-lg shadow-primary-500/30 transition flex items-center gap-2">
                        Bayar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </button>
                @else
                    <button class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 text-xs font-bold py-2.5 px-5 rounded-xl transition">
                        Detail
                    </button>
                @endif
            </div>

        </div>
        @empty
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-gray-900 dark:text-white font-bold mb-1">Belum Ada Pesanan</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Anda belum melakukan transaksi apapun.</p>
            <a href="{{ route('client.shop') }}" class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg text-sm font-bold">
                Mulai Belanja
            </a>
        </div>
        @endforelse
    </div>
</div>