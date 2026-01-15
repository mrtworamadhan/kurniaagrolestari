<div>
    <x-slot name="header">Katalog Pupuk</x-slot>

    <div class="sticky top-16 z-30 bg-gray-50 dark:bg-gray-900 pb-2 pt-2 -mx-4 px-4 transition-colors duration-300">
        
        <div class="relative shadow-sm">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Cari pupuk, nutrisi..." 
                class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 border-none rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-primary-500 text-gray-900 dark:text-white placeholder-gray-400 transition"
            >
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        <div class="mt-3 flex gap-2 overflow-x-auto hide-scrollbar pb-2">
            @foreach($categories as $cat)
            <button 
                wire:click="setCategory('{{ $cat }}')"
                class="px-4 py-1.5 rounded-full text-xs font-bold whitespace-nowrap border transition {{ $category === $cat ? 'bg-primary-600 text-white border-primary-600 shadow-md shadow-primary-500/30' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700' }}"
            >
                {{ $cat }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 pb-24 pt-2">
        @forelse($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-full group hover:shadow-md transition">
            
            <a href="{{ route('products.detail', $product->id) }}" class="relative aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/placeholder.png') }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-contain transition duration-500 group-hover:scale-110">
                
                <div class="absolute top-2 left-2">
                    <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2 py-0.5 rounded text-[9px] font-bold uppercase text-primary-700 dark:text-primary-400 shadow-sm border border-white/20">
                        {{ $product->category }}
                    </span>
                </div>
            </a>

            <div class="p-3 flex flex-col flex-1">
                @if(isset($product->tags) && count($product->tags) > 0)
                <div class="flex flex-wrap gap-1 mb-1">
                    @foreach($product->tags as $tag)
                        <span class="text-[9px] text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50 px-1.5 rounded border border-gray-100 dark:border-gray-700">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('products.detail', $product->id) }}" class="block">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm leading-tight mb-1 line-clamp-2 group-hover:text-primary-600 transition">
                        {{ $product->name }}
                    </h3>
                </a>
                
                <p class="text-[10px] text-gray-500 dark:text-gray-400 line-clamp-2 mb-3 leading-relaxed">
                    {{ Str::limit(strip_tags($product->description), 50) }}
                </p>
                
                <div class="mt-auto pt-3 border-t border-gray-50 dark:border-gray-700 flex items-center justify-between gap-2">
                    <div class="flex-1">
                        <p class="text-[10px] text-gray-400">Harga</p>
                        <p class="text-xs font-bold text-secondary-600 dark:text-secondary-400">
                            @if($product->price > 0)
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            @else
                                Hubungi Admin
                            @endif
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('client.shop.detail', $product->id) }}" 
                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 flex items-center justify-center hover:bg-primary-600 hover:text-white transition shadow-sm"
                        title="Lihat Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>

                        <a href="https://wa.me/6282171107777?text=Halo%20Admin,%20saya%20mau%20pesan%20{{ $product->name }}" 
                        target="_blank"
                        class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center hover:bg-green-600 hover:text-white transition shadow-sm"
                        title="Pesan via WA">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-16">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <p class="text-gray-500 dark:text-gray-400 font-medium">Produk tidak ditemukan.</p>
            <button wire:click="$set('search', '')" class="text-primary-600 text-sm font-bold mt-2">Reset Pencarian</button>
        </div>
        @endforelse
    </div>
</div>