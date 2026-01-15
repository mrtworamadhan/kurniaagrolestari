<x-slot name="header">Daftar Kebun</x-slot>
<div class="pb-20 pt-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="font-bold text-xl text-gray-900 dark:text-white">Daftar Kebun</h1>
        <a href="{{ route('client.garden.add') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 shadow-lg shadow-primary-500/30 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah
        </a>
    </div>

    <div class="space-y-6">
        @forelse($gardens as $garden)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden group hover:shadow-md transition">
            <a href="{{ route('client.garden.detail', $garden->id) }}" class="block">
                <div class="h-32 bg-gray-200 dark:bg-gray-700 bg-cover bg-center relative" 
                     style="background-image: url('{{ $garden->photo_url ?? asset('images/fotoKebun.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-3 left-4 text-white">
                        <h3 class="font-bold text-lg leading-tight">{{ $garden->name }}</h3>
                        <p class="text-xs opacity-90 flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $garden->address }} </p>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="grid grid-cols-3 gap-2 mb-4 text-center divide-x divide-gray-100 dark:divide-gray-700">
                        <div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Luas</p>
                            <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden->area_size }} Ha</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanah</p>
                            <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden->soilType->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Umur</p>
                            <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $garden->plant_age }} Th</p>
                        </div>
                    </div>
                    
                    <div class="w-full py-2.5 bg-secondary-50 dark:bg-secondary-900/20 text-secondary-700 dark:text-secondary-400 text-sm font-bold rounded-lg text-center group-hover:bg-secondary-500 group-hover:text-white transition">
                        Lihat Detail & Analisa
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
            <h3 class="text-gray-900 dark:text-white font-bold mb-1">Belum ada kebun</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Tambahkan data kebun Anda untuk dianalisa.</p>
            <a href="{{ route('client.garden.add') }}" class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg text-sm font-bold">
                Tambah Sekarang
            </a>
        </div>
        @endforelse
    </div>
</div>