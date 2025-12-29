<div class="bg-white dark:bg-gray-900 min-h-screen pb-20 pt-28 transition-colors duration-300">
    
    <div class="container mx-auto px-6 mb-6">
        <a href="{{ route('articles') }}" class="inline-flex items-center gap-2 text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Berita
        </a>
    </div>

    <div class="container mx-auto px-6 max-w-4xl text-center mb-10">
        <span class="inline-block px-3 py-1 bg-secondary-100 dark:bg-secondary-900/30 text-secondary-700 dark:text-secondary-400 text-xs font-bold uppercase tracking-wider rounded mb-4">
            {{ $article['category'] }}
        </span>
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
            {{ $article['title'] }}
        </h1>
        <div class="flex items-center justify-center gap-6 text-gray-500 dark:text-gray-400 text-sm">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                {{ $article['author'] }}
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ $article['date'] }}
            </span>
        </div>
    </div>

    <div class="container mx-auto px-6 max-w-5xl mb-12">
        <div class="aspect-[21/9] rounded-2xl overflow-hidden shadow-lg bg-gray-100 dark:bg-gray-800">
            <img src="{{ $article['image'] }}" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="container mx-auto px-6 max-w-6xl grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <div class="lg:col-span-8 text-gray-700 dark:text-gray-300 text-lg leading-relaxed space-y-6">
            {!! $article['content'] !!}
            
            <div class="border-t border-b border-gray-100 dark:border-gray-800 py-6 mt-12 flex items-center justify-between">
                <span class="font-bold text-gray-900 dark:text-white">Bagikan artikel ini:</span>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition shadow-lg shadow-green-500/20">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">
            <div class="bg-primary-900 dark:bg-gray-800 rounded-xl p-8 text-center text-white relative overflow-hidden border border-transparent dark:border-gray-700">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-3 text-white">Butuh Konsultasi Gratis?</h3>
                    <p class="text-primary-200 dark:text-gray-400 text-sm mb-6">Punya masalah kebun seperti di artikel ini? Diskusikan dengan ahli agronomi kami.</p>
                    <a href="https://wa.me/6282171107777" class="block w-full py-3 bg-secondary-500 hover:bg-secondary-400 text-white font-bold rounded-lg transition shadow-lg">
                        Chat WhatsApp
                    </a>
                </div>
            </div>

            @if(count($related) > 0)
            <div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-4 border-l-4 border-secondary-500 pl-3">Artikel Terkait</h3>
                <div class="flex flex-col gap-4">
                    @foreach($related as $item)
                    <a href="{{ route('articles.detail', $item['id']) }}" class="group flex gap-4 items-start">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden shrink-0 border border-transparent dark:border-gray-700">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition mb-1">
                                {{ $item['title'] }}
                            </h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $item['date'] }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

    </div>
</div>