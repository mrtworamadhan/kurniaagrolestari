<div class="bg-gray-50 dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <div class="bg-primary-900 dark:bg-gray-950 pt-32 pb-12 -mt-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Katalog Produk</h1>
            <p class="text-primary-200 dark:text-gray-400 max-w-2xl mx-auto">
                Temukan solusi nutrisi terbaik untuk tanaman Anda. Dari pembenah tanah hingga pemacu buah.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <aside class="w-full lg:w-1/4 space-y-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Pencarian</h3>
                    <div class="relative">
                        <input 
                            wire:model.live.debounce.300ms="search" 
                            type="text" 
                            placeholder="Cari nama pupuk..." 
                            class="w-full pl-10 pr-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition text-sm placeholder-gray-400 dark:placeholder-gray-500"
                        >
                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Kategori</h3>
                    <div class="space-y-2">
                        @foreach(['Semua', 'Semi Organik', 'Chemical Fertilizer', 'Pembenah Tanah', 'Nutrisi Makro'] as $cat)
                            <button 
                                wire:click="setCategory('{{ $cat }}')"
                                class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition flex justify-between items-center group {{ $category === $cat ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}"
                            >
                                {{ $cat }}
                                @if($category === $cat)
                                    <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gradient-to-br from-secondary-500 to-secondary-700 dark:from-secondary-600 dark:to-secondary-800 rounded-xl p-6 text-white text-center shadow-lg">
                    <h4 class="font-bold text-lg mb-2">Butuh Konsultasi?</h4>
                    <p class="text-secondary-100 text-sm mb-4">Tim ahli kami siap membantu menganalisa kebutuhan lahan Anda.</p>
                    <a href="https://wa.me/6282171107777" class="inline-block w-full py-2 bg-white dark:bg-gray-900 text-secondary-700 dark:text-secondary-400 font-bold rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Hubungi WhatsApp
                    </a>
                </div>
            </aside>

            <div class="w-full lg:w-3/4">
                
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Menampilkan <strong>{{ count($filteredProducts) }}</strong> produk</span>
                    
                    <div class="lg:hidden">
                        <select wire:model.live="category" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500">
                            <option value="Semua">Semua Kategori</option>
                            <option value="Semi Organik">Semi Organik</option>
                            <option value="Chemical Fertilizer">Chemical</option>
                            <option value="Pembenah Tanah">Pembenah Tanah</option>
                        </select>
                    </div>
                </div>

                @if(count($filteredProducts) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($filteredProducts as $product)
                        <div class="group bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:border-primary-200 dark:hover:border-primary-500/50 transition-all duration-300 flex flex-col h-full">
                            
                            <div class="relative aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute top-3 right-3">
                                    <span class="px-2 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur text-[10px] font-bold uppercase tracking-wider text-gray-800 dark:text-gray-200 rounded shadow-sm">
                                        {{ $product['category'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col flex-1">
                                <div class="mb-2 flex flex-wrap gap-1">
                                    @foreach($product['tags'] as $tag)
                                        <span class="text-[10px] bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 px-2 py-0.5 rounded font-semibold border border-primary-100 dark:border-primary-800">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                                    {{ $product['name'] }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-2 flex-1">
                                    {{ $product['desc'] }}
                                </p>

                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <span class="text-sm font-semibold text-secondary-600 dark:text-secondary-400">
                                        {{ $product['price'] }}
                                    </span>
                                    <a href="{{ route('products.detail', $product['id']) }}" class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-300 group-hover:bg-primary-500 group-hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                                <a href="{{ route('products.detail', $product['id']) }}" class="w-full mt-3 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm font-medium hover:bg-primary-500 hover:text-white hover:border-primary-500 dark:hover:border-primary-500 transition-colors text-center block">
                                    Detail Produk
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 border-dashed">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-gray-900 dark:text-white font-bold mb-1">Produk tidak ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Coba cari dengan kata kunci lain atau ubah filter.</p>
                        <button wire:click="$set('search', '')" class="mt-4 text-primary-600 dark:text-primary-400 font-medium hover:underline">
                            Reset Pencarian
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>