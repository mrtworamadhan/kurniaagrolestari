<div>
    <x-slot name="header">Daftar Kebun</x-slot>

    <a href="{{ route('solutions') }}" class="flex items-center justify-center gap-2 w-full py-3 mb-6 border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl text-primary-600 dark:text-primary-400 font-bold bg-primary-50 dark:bg-primary-900/10 hover:bg-primary-100 dark:hover:bg-primary-900/20 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Kebun Baru
    </a>

    <div class="space-y-6">
        @foreach($gardens as $garden)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="h-32 bg-gray-300 dark:bg-gray-700 bg-cover bg-center relative" style="background-image: url('{{ $garden['image'] }}');">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute bottom-3 left-3 text-white">
                    <h3 class="font-bold text-lg">{{ $garden['name'] }}</h3>
                    <p class="text-xs opacity-90 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $garden['location'] }}
                    </p>
                </div>
            </div>
            
            <div class="p-4">
                <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                    <div class="bg-gray-50 dark:bg-gray-900 p-2 rounded-lg border border-gray-100 dark:border-gray-800">
                        <p class="text-[10px] text-gray-500 dark:text-gray-400">Luas</p>
                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden['area'] }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 p-2 rounded-lg border border-gray-100 dark:border-gray-800">
                        <p class="text-[10px] text-gray-500 dark:text-gray-400">Tanah</p>
                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden['soil_type'] }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900 p-2 rounded-lg border border-gray-100 dark:border-gray-800">
                        <p class="text-[10px] text-gray-500 dark:text-gray-400">Umur</p>
                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden['plant_age'] }}</p>
                    </div>
                </div>
                
                <button class="w-full py-2.5 bg-secondary-500 hover:bg-secondary-600 text-white text-sm font-bold rounded-lg transition shadow-md shadow-secondary-500/20">
                    Lihat Detail & Rekomendasi
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>