<div class="bg-gray-50 dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">
    
    <div class="bg-primary-900 dark:bg-gray-950 pt-32 pb-16 -mt-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Wawasan Pertanian</h1>
            <p class="text-primary-200 dark:text-gray-400 text-lg">Berita terbaru, tips teknis, dan inovasi teknologi dari PT Kurnia Agro Lestari.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8">
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 flex flex-col md:flex-row gap-4 items-center justify-between mb-12 border border-gray-100 dark:border-gray-700 relative z-10 transition-colors">
            <div class="flex overflow-x-auto pb-2 md:pb-0 gap-2 w-full md:w-auto hide-scrollbar">
                @foreach(['Semua', 'Teknis Pertanian', 'Tips & Trik', 'Berita Perusahaan', 'Edukasi'] as $cat)
                    <button 
                        wire:click="setCategory('{{ $cat }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition {{ $category === $cat ? 'bg-primary-600 text-white shadow-md shadow-primary-500/30' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <div class="relative w-full md:w-80">
                <input 
                    wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Cari artikel..." 
                    class="w-full pl-10 pr-4 py-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                >
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        @if($featured)
        <div class="mb-12 group relative rounded-3xl overflow-hidden shadow-xl aspect-[16/7] md:aspect-[21/9]">
            <img src="{{ $featured['image'] }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-6 md:p-12 max-w-3xl">
                <span class="inline-block px-3 py-1 bg-secondary-500 text-white text-xs font-bold uppercase tracking-wider rounded mb-3">
                    {{ $featured['category'] }}
                </span>
                <h2 class="text-2xl md:text-4xl font-bold text-white mb-4 leading-tight group-hover:text-secondary-400 transition">
                    <a href="{{ route('articles.detail', $featured['id']) }}">
                        {{ $featured['title'] }}
                    </a>
                </h2>
                <p class="text-gray-300 mb-6 line-clamp-2 md:line-clamp-none">
                    {{ $featured['excerpt'] }}
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-xs">
                            {{ substr($featured['author'], 0, 1) }}
                        </div>
                        <span>{{ $featured['author'] }}</span>
                    </div>
                    <span>•</span>
                    <span>{{ $featured['date'] }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
                <a href="{{ route('articles.detail', $article['id']) }}" class="aspect-video bg-gray-100 dark:bg-gray-700 relative overflow-hidden">
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold uppercase text-primary-700 dark:text-primary-400 shadow-sm">
                            {{ $article['category'] }}
                        </span>
                    </div>
                </a>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-3">
                        <span>{{ $article['date'] }}</span>
                        <span>•</span>
                        <span>{{ $article['read_time'] }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                        <a href="{{ route('articles.detail', $article['id']) }}">
                            {{ $article['title'] }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-4 flex-1">
                        {{ $article['excerpt'] }}
                    </p>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">Oleh {{ $article['author'] }}</span>
                        <a href="{{ route('articles.detail', $article['id']) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-semibold text-sm flex items-center gap-1">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        @if(count($articles) == 0 && !$featured)
            <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-200 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada artikel yang cocok dengan pencarian Anda.</p>
                <button wire:click="$set('search', '')" class="text-primary-600 dark:text-primary-400 font-bold mt-2 hover:underline">Reset Filter</button>
            </div>
        @endif

    </div>
</div>