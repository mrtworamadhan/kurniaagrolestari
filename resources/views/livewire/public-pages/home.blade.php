<div class="flex flex-col gap-16 md:gap-24 pb-20">
    
    <section class="relative bg-primary-900 dark:bg-gray-950 overflow-hidden -mt-20 pt-32 pb-20 lg:pt-48 lg:pb-32">
        <div class="absolute inset-0 z-0 opacity-20 dark:opacity-10">
            <img src="https://images.unsplash.com/photo-1625246333195-58f2164be23e?q=80&w=2071&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Perkebunan Sawit">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-950/90 to-primary-800/80 dark:to-gray-900/90 z-0"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-7 flex flex-col items-start">
                    <span class="inline-block py-1 px-3 rounded-full bg-secondary-500/20 text-secondary-300 text-sm font-semibold mb-6 border border-secondary-500/30 backdrop-blur-sm">
                        Solusi Cerdas Pertanian Masa Depan
                    </span>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Maksimalkan Hasil Panen <br> 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">
                            Tanpa Merusak Tanah
                        </span>
                    </h1>
                    <p class="text-lg text-gray-300 mb-8 leading-relaxed max-w-2xl">
                        PT Kurnia Agro Lestari menghadirkan pupuk majemuk semi-organik dan teknologi pertanian presisi. 
                        Solusi hemat biaya hingga 50% dengan hasil panen meningkat hingga 70%.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="#produk" class="px-8 py-4 bg-primary-500 text-white font-semibold rounded-lg shadow-lg shadow-primary-500/40 hover:bg-primary-400 hover:-translate-y-1 transition-all">
                            Lihat Produk Kami
                        </a>
                        <a href="#konsultasi" class="px-8 py-4 bg-white/10 text-white backdrop-blur-md border border-white/20 font-semibold rounded-lg hover:bg-white/20 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 w-full mt-8 lg:mt-0">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4"> 
                        @foreach($stats as $stat)
                        <div class="bg-white/10 dark:bg-gray-800/40 backdrop-blur-md border border-white/10 dark:border-white/5 p-6 rounded-xl text-white hover:bg-white/15 dark:hover:bg-gray-800/60 transition duration-300">
                            <div class="text-4xl font-bold text-secondary-400 mb-1">{{ $stat['value'] }}</div>
                            <div class="font-semibold text-lg text-white">{{ $stat['label'] }}</div>
                            <div class="text-sm text-gray-300">{{ $stat['desc'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-primary-900 dark:text-white font-bold text-3xl mb-4">Mengapa Memilih Kami?</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Kami menerapkan metode <span class="font-bold text-primary-600 dark:text-primary-400">4P</span> untuk memastikan tanah Anda kembali subur dan hasil panen melimpah secara berkelanjutan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/30 transition group">
                <div class="w-12 h-12 bg-primary-50 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 transition duration-300">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Pembukaan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Membuka pori-pori tanah yang keras agar sirkulasi udara dan air kembali lancar.</p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/30 transition group">
                <div class="w-12 h-12 bg-secondary-50 dark:bg-secondary-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:bg-secondary-500 transition duration-300">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Perbaikan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Memperbaiki struktur kimia dan biologi tanah yang rusak akibat residu kimia berlebih.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/30 transition group">
                <div class="w-12 h-12 bg-primary-50 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-500 transition duration-300">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Penggemburan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Menjadikan tanah kembali gembur sehingga akar tanaman mudah menyerap nutrisi.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-gray-900/30 transition group">
                <div class="w-12 h-12 bg-secondary-50 dark:bg-secondary-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:bg-secondary-500 transition duration-300">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Penyuburan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Memberikan nutrisi makro & mikro lengkap untuk percepatan tumbuh dan pembuahan.</p>
            </div>
        </div>
    </section>

    <section id="produk" class="bg-gray-50 dark:bg-gray-900/50 py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-primary-900 dark:text-white font-bold text-3xl mb-2">Produk Unggulan</h2>
                    <p class="text-gray-500 dark:text-gray-400">Pupuk berkualitas yang diformulasikan untuk berbagai kondisi lahan.</p>
                </div>
                <a href="{{ route('products') }}" class="hidden md:flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold hover:text-primary-700 dark:hover:text-primary-300 transition">
                    Lihat Semua Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:border-primary-200 dark:hover:border-primary-500/50 transition-all duration-300 flex flex-col">
                    
                    <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-700 relative overflow-hidden">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-white/90 dark:bg-gray-900/90 text-primary-700 dark:text-primary-300 shadow-sm backdrop-blur-sm">
                                {{ $product['category'] }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <div class="mb-3">
                            @foreach($product['tags'] as $tag)
                                <span class="text-[10px] uppercase tracking-wider font-bold text-secondary-600 dark:text-secondary-400 bg-secondary-50 dark:bg-secondary-900/30 px-2 py-0.5 rounded border border-secondary-100 dark:border-secondary-800 mr-1">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                            {{ $product['name'] }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-4 flex-1">
                            {{ Str::limit($product['description'], 80) }}
                        </p>
                        
                        <a href="{{ route('products.detail', $product['id']) }}" class="w-full text-center py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 text-sm font-medium hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-colors">
                            Detail Produk
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 md:hidden text-center">
                <a href="{{ route('products') }}" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold">
                    Lihat Semua Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-10">
        <div 
            x-data="{ 
                active: 0, 
                total: {{ count($testimonials) }},
                next() { 
                    this.active = (this.active + 1) % this.total; 
                },
                prev() { 
                    this.active = (this.active - 1 + this.total) % this.total; 
                },
                init() {
                    setInterval(() => this.next(), 6000); 
                }
            }"
            class="bg-primary-900 dark:bg-gray-900 rounded-3xl p-8 md:p-16 relative overflow-hidden shadow-2xl"
        >
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-primary-800 dark:bg-primary-950 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-secondary-600 dark:bg-secondary-800 rounded-full blur-3xl opacity-30 pointer-events-none"></div>

            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Kata Mereka yang Telah Membuktikan</h2>
                    <p class="text-primary-100 dark:text-gray-300 mb-8 text-lg leading-relaxed">
                        Ribuan petani telah merasakan peningkatan hasil panen yang signifikan dengan metode kami. Bukan janji, tapi bukti nyata di lapangan.
                    </p>
                    
                    <div class="flex gap-4">
                        <button 
                            @click="prev()"
                            class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-primary-900 dark:hover:text-gray-900 transition active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button 
                            @click="next()"
                            class="w-12 h-12 rounded-full bg-secondary-500 text-white flex items-center justify-center hover:bg-secondary-400 transition shadow-lg shadow-secondary-500/30 active:scale-95"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="relative min-h-[300px]"> 
                    @foreach($testimonials as $index => $testi)
                    <div 
                        x-show="active === {{ $index }}"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-x-12"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300 absolute top-0 w-full" 
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-12"
                        class="w-full"
                        style="display: none;" 
                    >
                        <div class="bg-white/10 dark:bg-gray-800/60 backdrop-blur-md border border-white/10 dark:border-gray-700 p-8 rounded-2xl text-white shadow-lg">
                            <div class="flex gap-1 text-secondary-400 mb-4">
                                @for($i=0; $i<5; $i++) 
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            
                            <blockquote class="text-xl font-medium italic mb-6 leading-relaxed">
                                "{{ $testi['content'] }}"
                            </blockquote>
                            
                            <div class="flex items-center gap-4 border-t border-white/10 dark:border-gray-700/50 pt-6">
                                <div class="w-12 h-12 bg-secondary-500 rounded-full flex items-center justify-center text-lg font-bold shadow-inner">
                                    {{ substr($testi['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-lg">{{ $testi['name'] }}</div>
                                    <div class="text-sm text-primary-200 dark:text-gray-400 flex items-center gap-1">
                                        <span>{{ $testi['role'] }}</span>
                                        <span class="w-1 h-1 bg-primary-200 rounded-full"></span>
                                        <span>{{ $testi['location'] }}</span>
                                    </div>
                                    <div class="text-xs text-secondary-300 dark:text-secondary-400 mt-1">
                                        Produk: {{ $testi['product'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Siap Meningkatkan Hasil Panen Anda?</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-xl mx-auto">
            Jangan biarkan tanah Anda rusak. Beralihlah ke pupuk teknologi baru yang lebih hemat, efektif, dan ramah lingkungan.
        </p>
        <div class="flex justify-center gap-4">
            <a href="https://wa.me/6282171107777" target="_blank" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2 shadow-lg shadow-green-600/30">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                Chat WhatsApp
            </a>
        </div>
    </section>
</div>