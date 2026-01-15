<x-slot name="header">Tambah Kebun</x-slot>
<div class="pb-24 pt-4">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('client.garden') }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="font-bold text-xl text-gray-900 dark:text-white">Analisa Kebun Baru</h1>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-primary-600 dark:text-primary-400 mb-5 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 7m0 13V7m0 0L9 7"></path></svg>
                Data Fisik
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Lokasi (Desa/Kecamatan)</label>
                    <input wire:model="location" type="text" placeholder="Contoh: Desa Suka Maju"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                    @error('location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Luas (Ha)</label>
                        <input wire:model="area_size" type="number" step="0.1" placeholder="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Usia Tanam (Th)</label>
                        <input wire:model="plant_age" type="number" placeholder="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Jenis Tanah</label>
                    <div class="relative">
                        <select wire:model="soil_type_id" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm appearance-none">
                            <option value="">-- Pilih Jenis Tanah --</option>
                            @foreach($soilTypes as $soil)
                                <option value="{{ $soil->id }}">{{ $soil->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Topografi</label>
                        <div class="relative">
                            <select wire:model="topography" 
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm appearance-none">
                                <option value="Datar">Datar</option>
                                <option value="Berbukit">Berbukit</option>
                                <option value="Rawa">Rawa</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Varietas Bibit</label>
                        <input wire:model="plant_variety" type="text" placeholder="Contoh: PPKS" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-primary-600 dark:text-primary-400 mb-5 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Diagnosa & Target
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Keluhan / Kondisi Saat Ini</label>
                    <textarea wire:model="current_condition" rows="3" placeholder="Contoh: Daun menguning, buah trek, pelepah sengkleh..." 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm"></textarea>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Riwayat Pupuk (6 Bulan Terakhir)</label>
                    <textarea wire:model="fertilizer_history" rows="2" placeholder="Sebutkan jenis pupuk yang dipakai..."
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Panen Saat Ini</label>
                        <div class="relative">
                            <input wire:model="current_yield" type="text" placeholder="0"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm pl-4 pr-10">
                            <span class="absolute right-3 top-3 text-xs text-gray-400">Ton</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-primary-600 dark:text-primary-400 mb-1.5">Target Panen</label>
                        <div class="relative">
                            <input wire:model="target_yield" type="text" placeholder="0"
                                class="w-full px-4 py-3 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm pl-4 pr-10 font-semibold">
                            <span class="absolute right-3 top-3 text-xs text-primary-500">Ton</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-primary-600 dark:text-primary-400 mb-5 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Foto Kebun
            </h3>
            
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl cursor-pointer bg-primary-50 dark:bg-gray-900 hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-2 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold">Klik untuk upload foto</p>
                        <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1">Maks. 5MB per foto</p>
                    </div>
                    <input wire:model="photos" type="file" multiple class="hidden" />
                </label>
            </div>
            
            @if($photos)
            <div class="mt-4 flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                @foreach($photos as $photo)
                    <div class="relative shrink-0">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <button type="submit" class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition transform active:scale-95 flex items-center justify-center gap-2 text-lg">
            <svg wire:loading.remove class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            
            <span wire:loading.remove>Simpan & Ajukan Analisa</span>
            <span wire:loading>Mengirim Data...</span>
        </button>
    </form>
</div>