<div>
    <x-slot name="header">Belanja Produk</x-slot>

    <div class="sticky top-16 z-30 bg-gray-50 dark:bg-gray-900 pb-4 pt-2">
        <div class="relative">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Cari pupuk..." 
                class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm shadow-sm focus:ring-primary-500 focus:border-primary-500 transition"
            >
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        <div class="mt-3 flex gap-2 overflow-x-auto hide-scrollbar pb-1">
            @foreach(['Semua', 'Semi Organik', 'Chemical Fertilizer', 'Pembenah Tanah'] as $cat)
            <button 
                wire:click="setCategory('{{ $cat }}')"
                class="px-3 py-1.5 rounded-full text-xs font-medium whitespace-nowrap border transition {{ $category === $cat ? 'bg-primary-600 text-white border-primary-600' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-700' }}"
            >
                {{ $cat }}
            </button>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 pb-20">
        @foreach($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-full">
            <div class="aspect-square bg-gray-100 dark:bg-gray-700 relative">
                <img src="{{ $product['image'] }}" class="w-full h-full object-cover">
                @if(in_array('Best Seller', $product['tags']))
                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 text-[10px] font-bold px-2 py-0.5 rounded shadow-sm">Best Seller</span>
                @endif
            </div>
            <div class="p-3 flex flex-col flex-1">
                <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">{{ $product['category'] }}</p>
                <h3 class="font-bold text-gray-900 dark:text-white text-sm leading-tight mb-1 line-clamp-2">{{ $product['name'] }}</h3>
                
                <div class="mt-auto pt-3 flex items-center justify-between">
                    <span class="text-xs font-bold text-secondary-600 dark:text-secondary-400">Hubungi Admin</span>
                    <button class="w-8 h-8 rounded-full bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center hover:bg-primary-500 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>