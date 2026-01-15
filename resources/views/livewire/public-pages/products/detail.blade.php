<div class="bg-secondary-50 dark:bg-gray-900 min-h-screen pb-20 pt-5 transition-colors duration-300"> 
    
    <div class="container mx-auto px-6 mb-8">
        <nav class="flex text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products') }}" class="hover:text-primary-600 transition">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-primary-600 dark:text-primary-400 font-semibold">{{ $product->name }}</span>
        </nav>
    </div>

    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-lg border border-gray-100 dark:border-gray-700 sticky top-24">
                    <div class="aspect-square bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden relative">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/placeholder.png') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-contain">
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary-600 dark:bg-primary-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md uppercase tracking-wide">
                                {{ $product->category ?? 'Produk' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>
                
                <div class="text-2xl font-bold text-secondary-600 dark:text-secondary-400 mb-6">
                    @if($product->price > 0)
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                        <span class="text-sm font-normal text-gray-500 ml-1">/ sak</span>
                    @else
                        Harga: Hubungi Kami
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mb-10 border-b border-gray-200 dark:border-gray-700 pb-8">
                    <a href="https://wa.me/6281264915088?text=Halo%20Admin,%20saya%20tertarik%20dengan%20produk%20{{ $product->name }}" target="_blank" class="flex-1 bg-green-600 text-white text-center py-3.5 px-6 rounded-xl font-bold text-lg hover:bg-green-700 transition shadow-lg shadow-green-600/30 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>

                <div x-data="{ tab: 'desc' }" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    
                    <div class="flex border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <button @click="tab = 'desc'" 
                            :class="{ 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600 dark:border-primary-400 bg-white dark:bg-gray-800': tab === 'desc', 'text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400': tab !== 'desc' }" 
                            class="flex-1 py-4 text-sm font-bold transition">
                            Deskripsi
                        </button>
                        <button @click="tab = 'specs'" 
                            :class="{ 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600 dark:border-primary-400 bg-white dark:bg-gray-800': tab === 'specs', 'text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400': tab !== 'specs' }" 
                            class="flex-1 py-4 text-sm font-bold transition">
                            Kandungan
                        </button>
                        <button @click="tab = 'usage'" 
                            :class="{ 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600 dark:border-primary-400 bg-white dark:bg-gray-800': tab === 'usage', 'text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400': tab !== 'usage' }" 
                            class="flex-1 py-4 text-sm font-bold transition">
                            Cara Pakai
                        </button>
                    </div>

                    <div class="p-6 min-h-[300px]">
                        
                        <div x-show="tab === 'desc'" x-transition.opacity>
                            <article class="prose prose-green dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                                {!! $product->description !!}
                            </article>
                        </div>

                        <div x-show="tab === 'specs'" x-transition.opacity style="display: none;">
                            @if(!empty($product->specifications))
                                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                                    <table class="w-full text-sm text-left">
                                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 font-semibold border-b border-gray-200 dark:border-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 w-1/2">Unsur Hara / Parameter</th>
                                                <th class="px-6 py-3">Nilai Kandungan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                            @foreach($product->specifications as $key => $value)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                    {{ $key }}
                                                </td>
                                                <td class="px-6 py-4 text-secondary-600 dark:text-secondary-400 font-bold">
                                                    @if($value != "")
                                                        {{ $value }}%
                                                    @else
                                                        <span class="text-green-600 dark:text-green-400 text-xs px-2 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">Tersedia</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-10 text-gray-500">
                                    <p>Data spesifikasi lengkap belum tersedia.</p>
                                </div>
                            @endif
                        </div>

                        <div x-show="tab === 'usage'" x-transition.opacity style="display: none;">
                            @if($product->usage_instruction)
                                <div class="prose prose-green dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                                    {!! nl2br(e($product->usage_instruction)) !!}
                                </div>
                                
                                <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg flex gap-3">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-sm text-yellow-800 dark:text-yellow-200">
                                        <strong>Catatan:</strong> Konsultasikan dengan agronomis kami jika kondisi tanaman mengalami gejala defisiensi parah.
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-10 text-gray-500">
                                    <p>Instruksi penggunaan umum belum tersedia. Silakan hubungi admin.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @if($relatedProducts->count() > 0)
    <div class="container mx-auto px-6 mt-20 border-t border-gray-200 dark:border-gray-700 pt-12">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Produk Sejenis</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.detail', $related->id) }}" class="block bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-300 transition p-4 flex items-center gap-4 group">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden shrink-0">
                        <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('images/products/placeholder.png') }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition line-clamp-1">{{ $related->name }}</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $related->category }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>