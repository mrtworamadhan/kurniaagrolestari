<x-slot name="header">Dashboard</x-slot>
<div class="pb-20 pt-2">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Selamat Datang,</p>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }} 👋</h1>
        </div>
        <a href="{{ route('client.profile') }}" class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden border-2 border-white dark:border-gray-800 shadow-sm">
            <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </a>
    </div>

    <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl p-6 text-white shadow-lg shadow-primary-500/30 mb-6 relative overflow-hidden">
        <div class="relative z-10 flex justify-between items-center">
            <div>
                <p class="text-primary-100 text-xs font-medium flex items-center gap-1 uppercase tracking-wide">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $weather['loc'] }}
                </p>
                <h2 class="text-4xl font-bold mt-2 mb-1">{{ $weather['temp'] }}°C</h2>
                <p class="text-sm opacity-90 font-medium">{{ $weather['desc'] }}</p>
            </div>
            
            <svg class="w-20 h-20 text-yellow-300 animate-pulse drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" /></svg>
        </div>
        <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    @if($totalDebt > 0)
    <div class="bg-red-500 rounded-2xl p-5 text-white shadow-lg shadow-red-500/30 relative overflow-hidden mb-6 group cursor-pointer hover:scale-[1.02] transition">
        <div class="absolute right-0 top-0 opacity-10 transform translate-x-4 -translate-y-4">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
        </div>
        <div class="relative z-10 flex justify-between items-end">
            <div>
                <p class="text-red-100 text-xs font-bold uppercase tracking-wider mb-1">Tagihan Jatuh Tempo</p>
                <h3 class="text-2xl font-bold">Rp {{ number_format($totalDebt, 0, ',', '.') }}</h3>
                <p class="text-xs text-red-100 mt-2">Mohon segera lakukan pembayaran agar pengiriman selanjutnya lancar.</p>
            </div>
            <a href="#" class="bg-white text-red-600 p-2 rounded-lg shadow-sm hover:bg-red-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 mb-2">
                <div class="p-1.5 bg-green-100 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Luas</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalArea }} <span class="text-sm font-normal text-gray-500">Ha</span></p>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2 mb-2">
                <div class="p-1.5 bg-orange-100 dark:bg-orange-900/30 rounded-lg text-orange-600 dark:text-orange-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Jadwal Pupuk</p>
            </div>
            <p class="text-lg font-bold text-orange-500">{{ $nextSchedule }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4 px-1">
        <h3 class="font-bold text-lg text-gray-900 dark:text-white">Kebun Saya</h3>
        <a href="{{ route('client.garden') }}" class="text-xs text-primary-600 dark:text-primary-400 font-semibold hover:underline">Lihat Semua</a>
    </div>

    <div class="space-y-4">
        @forelse($gardens as $garden)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex gap-4 transition hover:bg-gray-50 dark:hover:bg-gray-700/50 group">
            
            <div class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-xl bg-cover bg-center shrink-0 border border-gray-100 dark:border-gray-600"
                style="background-image: url('{{ asset('images/iconKebun.jpg') }}');">
            </div>

            
            <div class="flex-1 py-1">
                <h4 class="font-bold text-gray-900 dark:text-white mb-1 group-hover:text-primary-600 transition">{{ $garden->name }}</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 flex items-center gap-1">
                    <span>{{ $garden->plant_type }}</span> • <span>{{ $garden->plant_age }} Tahun</span>
                </p>
                
                <div class="flex gap-2">
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-[10px] rounded-md font-medium border border-gray-200 dark:border-gray-600">
                        {{ $garden->area_size }} Ha
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
            <p class="text-gray-500 text-sm mb-2">Belum ada data kebun.</p>
            <a href="#" class="text-primary-600 font-bold text-sm">Tambah Kebun</a>
        </div>
        @endforelse
    </div>
</div>