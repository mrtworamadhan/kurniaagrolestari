<x-slot name="header">Detail Kebun</x-slot>
<div class="pb-20 pt-4" x-data="{ tab: 'kondisi' }">
    
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('client.garden') }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="font-bold text-lg text-gray-900 dark:text-white leading-tight">{{ $garden->name }}</h1>
            <p class="text-xs text-gray-500">{{ $garden->address }}</p>
        </div>
    </div>

    <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-5 text-white shadow-lg mb-6 relative overflow-hidden">
        <div class="relative z-10 grid grid-cols-3 gap-4 text-center divide-x divide-primary-500/50">
            <div>
                <p class="text-[10px] text-primary-200 uppercase">Luas</p>
                <p class="font-bold text-lg">{{ $garden->area_size }} Ha</p>
            </div>
            <div>
                <p class="text-[10px] text-primary-200 uppercase">Tanah</p>
                <p class="font-bold text-lg">{{ $garden->soilType->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] text-primary-200 uppercase">Umur</p>
                <p class="font-bold text-lg">{{ $garden->plant_age }} Th</p>
            </div>
        </div>
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 text-white opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
    </div>

    <div class="flex bg-white dark:bg-gray-800 p-1 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <button @click="tab = 'kondisi'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm': tab === 'kondisi', 'text-gray-500 hover:bg-gray-50': tab !== 'kondisi' }"
            class="flex-1 py-2 text-xs rounded-lg transition text-center">
            Kondisi Awal
        </button>
        <button @click="tab = 'pupuk'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm': tab === 'pupuk', 'text-gray-500 hover:bg-gray-50': tab !== 'pupuk' }"
            class="flex-1 py-2 text-xs rounded-lg transition text-center">
            Riwayat Pupuk
        </button>
        <button @click="tab = 'panen'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm': tab === 'panen', 'text-gray-500 hover:bg-gray-50': tab !== 'panen' }"
            class="flex-1 py-2 text-xs rounded-lg transition text-center">
            Hasil Panen
        </button>
    </div>

    <div x-show="tab === 'kondisi'" x-transition.opacity>
        @if($initialAssessment)
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
                
                <div class="flex items-start gap-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-100 dark:border-yellow-800">
                    <div class="text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Diagnosa Masalah</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">{{ $initialAssessment->notes }}</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                        <span class="text-sm text-gray-500">Varietas Bibit</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $initialAssessment->plant_variety ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                        <span class="text-sm text-gray-500">Topografi</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $initialAssessment->topography ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                        <span class="text-sm text-gray-500">Berat Janjang (BJR)</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $initialAssessment->bunch_weight ?? '-' }} kg</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-xl text-center">
                        <p class="text-[10px] text-gray-500">Panen Awal</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $initialAssessment->current_yield ?? '0' }} Ton</p>
                    </div>
                    <div class="bg-primary-50 dark:bg-primary-900/20 p-3 rounded-xl text-center border border-primary-100 dark:border-primary-800">
                        <p class="text-[10px] text-primary-600 dark:text-primary-400">Target Panen</p>
                        <p class="font-bold text-primary-700 dark:text-primary-400">{{ $initialAssessment->target_yield ?? '0' }} Ton</p>
                    </div>
                </div>

                @if($initialAssessment->visual_evidence)
                <div>
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white mb-3">Dokumentasi Awal</h4>
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @foreach($initialAssessment->visual_evidence as $photo)
                            <div class="w-24 h-24 rounded-lg bg-gray-200 flex-shrink-0 bg-cover bg-center border border-gray-200" style="background-image: url('{{ asset('storage/' . $photo) }}');"></div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        @else
            <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-2xl">
                <p class="text-gray-500 text-sm">Belum ada data assessment awal.</p>
            </div>
        @endif
    </div>

    <div x-show="tab === 'pupuk'" x-transition.opacity style="display: none;">
        
        <button wire:click="$set('isFertilizerModalOpen', true)" class="w-full py-3 mb-4 bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 border border-dashed border-primary-300 dark:border-primary-700 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Catat Pemupukan Baru
        </button>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
            @if($fertilizationHistory->count() > 0)
                <div class="relative pl-4 border-l-2 border-gray-200 dark:border-gray-700 space-y-8">
                    @foreach($fertilizationHistory as $pupuk)
                    <div class="relative">
                        <div class="absolute -left-[21px] top-1 w-3 h-3 rounded-full bg-green-500 ring-4 ring-white dark:ring-gray-800"></div>
                        <p class="text-xs text-gray-400 mb-1">{{ $pupuk->fertilization_date->translatedFormat('d F Y') }}</p>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg mt-1">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white text-sm">{{ $pupuk->fertilizer_name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Dosis: {{ $pupuk->dosage }} {{ $pupuk->unit }}</p>
                                </div>
                                @if($pupuk->photo_evidence)
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg bg-cover bg-center shrink-0" style="background-image: url('{{ asset('storage/'.$pupuk->photo_evidence) }}')"></div>
                                @endif
                            </div>
                            @if($pupuk->notes)
                                <p class="text-xs text-gray-500 mt-2 italic border-t border-gray-200 dark:border-gray-600 pt-2">"{{ $pupuk->notes }}"</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <p class="text-sm">Belum ada data pemupukan.</p>
                </div>
            @endif
        </div>
    </div>

    <div x-show="tab === 'panen'" x-transition.opacity style="display: none;">
        
        <button wire:click="$set('isHarvestModalOpen', true)" class="w-full py-3 mb-4 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 border border-dashed border-yellow-300 dark:border-yellow-700 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-yellow-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Catat Hasil Panen
        </button>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            @if($harvestHistory->count() > 0)
                <div class="p-5 bg-primary-600 text-white text-center">
                    <p class="text-xs text-primary-100 mb-1">Total Produksi</p>
                    <h3 class="text-3xl font-bold">{{ number_format($harvestHistory->sum('weight_kg') / 1000, 2, ',', '.') }} <span class="text-sm font-normal">Ton</span></h3>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($harvestHistory as $panen)
                    <div class="p-4 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-500 font-bold text-xs shrink-0">
                                {{ $panen->harvest_date->format('d') }}
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $panen->harvest_date->translatedFormat('M Y') }}</p>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">{{ number_format($panen->weight_kg, 0, ',', '.') }} Kg</h4>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($panen->bunch_count)
                                <span class="block text-xs text-gray-500">{{ $panen->bunch_count }} Janjang</span>
                                <span class="inline-block px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 rounded text-[10px] text-gray-600 dark:text-gray-300 font-bold mt-1">
                                    BJR: {{ round($panen->weight_kg / $panen->bunch_count, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 px-5">
                    <p class="text-gray-500 text-sm">Belum ada data panen.</p>
                </div>
            @endif
        </div>
    </div>

    @if($isFertilizerModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl transform transition-all scale-100">
            
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/50">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Catat Pemupukan
                </h3>
                <button wire:click="$set('isFertilizerModalOpen', false)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Tanggal Aplikasi</label>
                    <input wire:model="f_date" type="date" 
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Nama Pupuk</label>
                    <input wire:model="f_name" type="text" placeholder="Contoh: NPK 16-16-16" 
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Dosis</label>
                        <input wire:model="f_dosage" type="number" step="0.1" placeholder="0"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Satuan</label>
                        <div class="relative">
                            <select wire:model="f_unit" 
                                class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm appearance-none">
                                <option>Kg/Pokok</option>
                                <option>Gr/Pokok</option>
                                <option>Karung</option>
                                <option>Liter</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Foto Bukti (Opsional)</label>
                    <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-[10px] text-gray-500">Klik upload foto</p>
                        </div>
                        <input wire:model="f_photo" type="file" class="hidden">
                    </label>
                    @if($f_photo)
                        <p class="text-[10px] text-green-600 mt-1">Foto terpilih: {{ $f_photo->getClientOriginalName() }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Catatan Tambahan</label>
                    <textarea wire:model="f_notes" rows="2" placeholder="Catatan kondisi saat pemupukan..."
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm"></textarea>
                </div>

                <button wire:click="saveFertilization" class="w-full py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition transform active:scale-95 flex items-center justify-center gap-2">
                    <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span wire:loading.remove>Simpan Data</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if($isHarvestModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl transform transition-all scale-100">
            
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-yellow-50 dark:bg-yellow-900/20">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Catat Hasil Panen
                </h3>
                <button wire:click="$set('isHarvestModalOpen', false)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Tanggal Panen</label>
                    <input wire:model="h_date" type="date" 
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Total Berat (Kg)</label>
                        <input wire:model="h_weight" type="number" step="1" placeholder="0"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white font-bold text-primary-600 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Jml Janjang</label>
                        <input wire:model="h_bunch" type="number" placeholder="0"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 dark:text-gray-300 mb-1.5">Catatan Panen</label>
                    <textarea wire:model="h_notes" rows="2" placeholder="Kondisi buah, cuaca, dll..."
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm"></textarea>
                </div>

                <button wire:click="saveHarvest" class="w-full py-3.5 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl shadow-lg shadow-yellow-500/30 transition transform active:scale-95 flex items-center justify-center gap-2">
                    <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span wire:loading.remove>Simpan Panen</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>