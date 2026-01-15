<div class="pb-24 pt-2">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('client.garden.detail', $assessment->garden_id) }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="font-bold text-xl text-gray-900 dark:text-white">Laporan Analisa</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 mb-6 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-500 to-green-500"></div>
        
        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Paket Analisa</p>
        <h2 class="text-2xl font-extrabold text-primary-600 dark:text-primary-400 uppercase">
            {{ $assessment->labResult->package_type ?? 'Standard Lab' }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            {{ $assessment->garden->name }} • 
            {{ $assessment->labResult ? $assessment->labResult->checked_at->format('d M Y') : '-' }}
        </p>
        
        @if($assessment->recommendation)
        <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-100 dark:border-gray-700 text-left">
            <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Summary Agronomis</p>
            <p class="text-sm text-gray-700 dark:text-gray-300 italic">
                "{!! $assessment->recommendation->summary ?? 'Tidak ada ringkasan.'!!}"
            </p>
        </div>
        @endif
    </div>

    @if($assessment->labResult)
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <h3 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2 border-b border-gray-100 dark:border-gray-700 pb-3">
            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            Parameter Kimia Tanah
        </h3>
        
        <div class="grid grid-cols-1 gap-5">
            
            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-600 dark:text-gray-300 font-bold">pH Tanah</span>
                    <span class="font-bold {{ $assessment->labResult->ph_level < 5 ? 'text-red-500' : ($assessment->labResult->ph_level > 7.5 ? 'text-yellow-500' : 'text-green-500') }}">
                        {{ $assessment->labResult->ph_level }}
                    </span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-3 relative">
                    <div class="absolute top-0 bottom-0 w-1 bg-black dark:bg-white rounded" 
                         style="left: {{ ($assessment->labResult->ph_level / 14) * 100 }}%"></div>
                    <div class="w-full h-full rounded-full opacity-50" 
                         style="background: linear-gradient(90deg, #ef4444 0%, #eab308 40%, #22c55e 50%, #eab308 60%, #ef4444 100%);"></div>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Ideal: 5.5 - 7.0</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                    <p class="text-[10px] text-gray-500 uppercase">C-Organik</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->c_organic }}%</p>
                </div>
                 <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                    <p class="text-[10px] text-gray-500 uppercase">KTK</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->ktk }}</p>
                </div>
            </div>

            <div class="space-y-3">
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-600 dark:text-gray-300">N-Total</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->n_total }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ min(($assessment->labResult->n_total / 1) * 100, 100) }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-600 dark:text-gray-300">P-Available</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->p_available }} ppm</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                         <div class="bg-green-500 h-2 rounded-full" style="width: {{ min(($assessment->labResult->p_available / 100) * 100, 100) }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-600 dark:text-gray-300">K-Exchange</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->k_exchange }} cmol</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ min(($assessment->labResult->k_exchange / 2) * 100, 100) }}%"></div>
                    </div>
                </div>
                
                 <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-600 dark:text-gray-300">Mg-Exchange</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ $assessment->labResult->mg_exchange }} cmol</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: {{ min(($assessment->labResult->mg_exchange / 2) * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>
            
            @if($assessment->labResult->lab_notes)
            <div class="mt-2 p-3 bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-800 rounded-lg">
                <p class="text-[10px] text-yellow-800 dark:text-yellow-500 font-bold mb-1">Catatan Lab:</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $assessment->labResult->lab_notes }}</p>
            </div>
            @endif

        </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center shadow-sm border border-gray-100 mb-6">
        <p class="text-gray-500 text-sm">Data Laboratorium belum diinput.</p>
    </div>
    @endif

    @if(!empty($recommendations))
    <div class="bg-primary-600 rounded-2xl p-6 shadow-lg shadow-primary-500/30 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="font-bold text-lg mb-1">Rekomendasi Pemupukan</h3>
            <p class="text-primary-100 text-sm mb-6">Solusi PT KAL berdasarkan hasil analisa di atas:</p>

            @foreach($recommendations as $rec)
            <div class="bg-white rounded-xl p-4 text-gray-900 mb-3 flex gap-4 items-center shadow-md">
                
                <div class="w-14 h-14 bg-gray-100 rounded-lg shrink-0 flex items-center justify-center overflow-hidden border border-gray-100">
                    <img src="{{ $rec['product']->image ? asset('storage/' . $rec['product']->image) : asset('images/products/product.png') }}" 
                         class="w-full h-full object-contain">
                </div>
                
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-primary-700">{{ $rec['product']->name }}</h4>
                    <p class="text-[10px] text-gray-500 line-clamp-1">{{ $rec['product']->category ?? 'Pupuk' }}</p>
                    
                    <div class="mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        <span class="text-xs font-medium text-gray-600">Rotasi: {{ $rec['frequency'] }} x Aplikasi</span>
                    </div>
                </div>
                
                <div class="text-right pl-2 border-l border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase">Dosis</p>
                    <p class="font-bold text-lg text-primary-600">{{ $rec['dosage'] }}</p>
                    <p class="text-[9px] text-gray-400">gr/pokok</p> </div>
            </div>
            @endforeach

            @if($assessment->recommendation->application_notes)
            <div class="mt-4 pt-4 border-t border-primary-500">
                <p class="text-xs font-bold text-primary-100 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Catatan Agronomis:
                </p>
                <p class="text-xs text-white opacity-90 leading-relaxed italic">"{!! $assessment->recommendation->application_notes !!}"</p>
            </div>
            @endif

            <div class="mt-6 pt-4 border-t border-primary-500 flex justify-between items-center">
                <p class="text-xs text-primary-100">Butuh produk ini?</p>
                <a href="{{ route('client.shop') }}" class="px-4 py-2 bg-white text-primary-600 font-bold text-xs rounded-lg hover:bg-gray-100 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Beli Paket
                </a>
            </div>
        </div>
        
        <svg class="absolute -bottom-10 -right-10 w-48 h-48 text-white opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
    </div>
    @else
    <div class="bg-gray-100 dark:bg-gray-800 rounded-2xl p-6 text-center border border-dashed border-gray-300">
        <p class="text-gray-500 text-sm">Rekomendasi belum diterbitkan oleh Agronomis.</p>
    </div>
    @endif
</div>