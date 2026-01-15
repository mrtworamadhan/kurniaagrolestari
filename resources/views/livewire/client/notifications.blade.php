<x-slot name="header">Notifikasi</x-slot>
<div class="pb-24 pt-4">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('client.profile') }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition hover:bg-gray-200 dark:hover:bg-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="font-bold text-xl text-gray-900 dark:text-white">Notifikasi</h1>
        </div>
        
        @if($notifications->whereNull('read_at')->count() > 0)
        <button wire:click="markAllAsRead" class="text-xs font-bold text-primary-600 dark:text-primary-400 hover:text-primary-700 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Baca Semua
        </button>
        @endif
    </div>

    <div class="space-y-3">
        @forelse($notifications as $notif)
        <div class="relative overflow-hidden rounded-2xl p-4 shadow-sm border transition-all duration-200
            {{ $notif->read_at ? 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700' : 'bg-primary-50 dark:bg-primary-900/10 border-primary-100 dark:border-primary-800' }}">
            
            <div class="flex gap-4">
                <div class="shrink-0 mt-1">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                        {{ $notif->read_at ? 'bg-gray-100 dark:bg-gray-700 text-gray-500' : 'bg-white text-primary-600 shadow-sm' }}">
                        
                        @if(isset($notif->data['type']) && $notif->data['type'] == 'order')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @elseif(isset($notif->data['type']) && $notif->data['type'] == 'schedule')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        @endif
                    </div>
                </div>

                <div class="flex-1">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white {{ !$notif->read_at ? 'text-primary-700 dark:text-primary-400' : '' }}">
                            {{ $notif->data['title'] ?? 'Info Terbaru' }}
                        </h4>
                        <span class="text-[10px] text-gray-400 whitespace-nowrap ml-2">
                            {{ $notif->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $notif->data['message'] ?? 'Tidak ada detail pesan.' }}
                    </p>

                    <button wire:click="delete('{{ $notif->id }}')" class="mt-3 text-[10px] text-gray-400 hover:text-red-500 transition flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </div>
            </div>
            
            @if(!$notif->read_at)
                <div class="absolute top-4 right-4 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
            @endif
        </div>
        @empty
        <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            </div>
            <h3 class="text-gray-900 dark:text-white font-bold mb-1">Belum Ada Notifikasi</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Anda akan menerima info pesanan & jadwal di sini.</p>
        </div>
        @endforelse
    </div>
</div>