<x-slot name="header">Detail Product</x-slot>
<div class="pb-24 pt-2" x-data="{ tab: 'desc' }">
    
    <div class="flex items-center gap-3 mb-4">
        <a href="{{ route('client.shop') }}" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 transition hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="font-bold text-lg text-gray-900 dark:text-white line-clamp-1">{{ $product->name }}</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
        <div class="aspect-square bg-gray-50 dark:bg-gray-700 relative">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/placeholder.png') }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-contain">
            
            <div class="absolute top-3 left-3">
                <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-bold uppercase text-primary-700 dark:text-primary-400 shadow-sm">
                    {{ $product->category }}
                </span>
            </div>
        </div>
        
        <div class="p-5">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h2>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Harga per Unit</p>
                    <p class="text-xl font-bold text-secondary-600 dark:text-secondary-400">
                        @if($product->price > 0)
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        @else
                            Hubungi Admin
                        @endif
                    </p>
                </div>
                <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-full">
                    Tersedia
                </span>
            </div>
        </div>
    </div>

    <div class="flex bg-white dark:bg-gray-800 p-1 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6 sticky top-16 z-20">
        <button @click="tab = 'desc'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm dark:bg-gray-700 dark:text-white': tab === 'desc', 'text-gray-500 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700/50': tab !== 'desc' }"
            class="flex-1 py-2.5 text-xs rounded-lg transition text-center">
            Deskripsi
        </button>
        <button @click="tab = 'specs'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm dark:bg-gray-700 dark:text-white': tab === 'specs', 'text-gray-500 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700/50': tab !== 'specs' }"
            class="flex-1 py-2.5 text-xs rounded-lg transition text-center">
            Kandungan
        </button>
        <button @click="tab = 'usage'" 
            :class="{ 'bg-primary-50 text-primary-700 font-bold shadow-sm dark:bg-gray-700 dark:text-white': tab === 'usage', 'text-gray-500 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700/50': tab !== 'usage' }"
            class="flex-1 py-2.5 text-xs rounded-lg transition text-center">
            Cara Pakai
        </button>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 min-h-[200px]">
        
        <div x-show="tab === 'desc'" x-transition.opacity>
            <article class="prose prose-sm prose-green dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                {!! $product->description !!}
            </article>
        </div>

        <div x-show="tab === 'specs'" x-transition.opacity style="display: none;">
            @if(!empty($product->specifications))
                <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-gray-700">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 font-semibold border-b border-gray-100 dark:border-gray-700">
                            <tr>
                                <th class="px-4 py-3 w-1/2">Parameter</th>
                                <th class="px-4 py-3">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @foreach($product->specifications as $key => $value)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $key }}</td>
                                <td class="px-4 py-3 text-secondary-600 dark:text-secondary-400 font-bold">
                                    {{ $value ? $value . '%' : 'Tersedia' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-500 py-8 text-sm">Data spesifikasi belum tersedia.</p>
            @endif
        </div>

        <div x-show="tab === 'usage'" x-transition.opacity style="display: none;">
            @if($product->usage_instruction)
                <div class="prose prose-sm prose-green dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    {!! nl2br(e($product->usage_instruction)) !!}
                </div>
                
                <div class="mt-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800 rounded-lg flex gap-3">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs text-yellow-800 dark:text-yellow-200">
                        Konsultasikan dosis dengan agronomis kami jika tanaman mengalami masalah khusus.
                    </p>
                </div>
            @else
                <p class="text-center text-gray-500 py-8 text-sm">Instruksi penggunaan belum tersedia.</p>
            @endif
        </div>
    </div>

    @if($relatedProducts->count() > 0)
    <div class="mt-8">
        <h3 class="font-bold text-gray-900 dark:text-white mb-4 px-1">Produk Sejenis</h3>
        <div class="flex overflow-x-auto gap-4 pb-4 -mx-4 px-4 hide-scrollbar">
            @foreach($relatedProducts as $related)
            <a href="{{ route('client.shop.detail', $related->id) }}" class="block w-40 shrink-0 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="aspect-square bg-gray-100 dark:bg-gray-700">
                    <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('images/products/placeholder.png') }}" class="w-full h-full object-contain">
                </div>
                <div class="p-3">
                    <h4 class="font-bold text-xs text-gray-900 dark:text-white line-clamp-2 mb-1">{{ $related->name }}</h4>
                    <p class="text-[10px] text-gray-500">{{ $related->category }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="fixed bottom-15 left-0 right-0 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 p-4 pb-6 lg:pb-4 z-40 flex items-center justify-between gap-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="hidden sm:block">
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Harga</p>
            <p class="text-lg font-bold text-gray-900 dark:text-white">
                {{ $product->price > 0 ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Hubungi Admin' }}
            </p>
        </div>
        
        <a href="https://wa.me/6282171107777?text=Halo%20Admin,%20saya%20tertarik%20pesan%20{{ $product->name }}%20(Via%20App%20Client)" 
           target="_blank"
           class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-green-600/30 flex items-center justify-center gap-2 transition active:scale-95">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            Pesan Sekarang
        </a>
    </div>

</div>