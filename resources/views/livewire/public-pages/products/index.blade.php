<div class="bg-gray-50 dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <div class="bg-primary-900 dark:bg-gray-950 pt-32 pb-12 -mt-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Katalog Produk</h1>
            <p class="text-primary-200 dark:text-gray-400 max-w-2xl mx-auto">
                Solusi nutrisi terbaik untuk hasil panen maksimal. Diformulasikan khusus untuk lahan gambut dan mineral.
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
                            placeholder="Cari pupuk..." 
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-primary-500 focus:border-primary-500 transition"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Kategori</h3>
                    <div class="space-y-1">
                        @foreach($categories as $cat)
                            <button 
                                wire:click="setCategory('{{ $cat }}')"
                                class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition flex justify-between items-center {{ $category === $cat ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}"
                            >
                                {{ $cat }}
                                @if($category === $cat)
                                    <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Menampilkan <strong>{{ $products->total() }}</strong> produk</span>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 hover:border-primary-200 dark:hover:border-primary-500/50 transition-all duration-300 flex flex-col h-full">
                            
                            <div class="relative aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/placeholder.png') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-contain group-hover:scale-110 transition duration-700 ease-out">
                                
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 bg-white/95 dark:bg-gray-900/90 backdrop-blur text-[10px] font-bold uppercase tracking-wide text-primary-700 dark:text-primary-300 rounded shadow-sm">
                                        {{ $product->category ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-1" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </h3>
                                
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($product->description), 100) }}
                                </p>

                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <span class="text-sm font-bold text-secondary-600 dark:text-secondary-400">
                                        @if($product->price > 0)
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        @else
                                            Hubungi Kami
                                        @endif
                                    </span>
                                    
                                    <a href="{{ route('products.detail', $product->id) }}" class="flex items-center gap-1 text-sm font-semibold text-primary-600 dark:text-primary-400 hover:underline">
                                        Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>

                @else
                    <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-gray-900 dark:text-white font-bold">Produk tidak ditemukan</h3>
                        <button wire:click="$set('search', '')" class="mt-2 text-primary-600 hover:underline text-sm">Reset Pencarian</button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>