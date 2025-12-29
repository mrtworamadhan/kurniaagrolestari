<!DOCTYPE html>
<html 
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    class="scroll-smooth"
    x-data="{ 
        darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');"
    :class="{ 'dark': darkMode }"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'PT Kurnia Agro Lestari' }} - Solusi Pertanian Terbaik</title>
    <meta name="description" content="{{ $description ?? 'Mitra terbaik solusi pertanian Anda. Menyediakan pupuk berkualitas (NPK, Nitroganik), teknologi drone, dan konsultasi ahli untuk hasil panen maksimal.' }}">
    <meta name="keywords" content="Pupuk Sawit, Kurnia Agro Lestari, NPK, Nitroganik, Pertanian Riau, Pupuk Pekanbaru, Konsultan Pertanian">
    <meta name="author" content="PT Kurnia Agro Lestari">

    <link rel="icon" type="image/png" href="{{ asset('images/logoKAL.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logoKAL.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="{{ $title ?? 'PT Kurnia Agro Lestari' }}">
    <meta property="og:description" content="{{ $description ?? 'Solusi cerdas pertanian masa depan. Tingkatkan hasil panen sawit Anda hingga 70% dengan teknologi pupuk kami.' }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}"> 

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $title ?? 'PT Kurnia Agro Lestari' }}">
    <meta property="twitter:description" content="{{ $description ?? 'Solusi cerdas pertanian masa depan. Tingkatkan hasil panen sawit Anda hingga 70%.' }}">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-gray-800 bg-secondary-50 dark:bg-gray-900 dark:text-gray-100 selection:bg-primary-500 selection:text-white transition-colors duration-300">

    <header 
        x-data="{ mobileMenuOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="{ 
            'bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-md': scrolled, 
            'bg-transparent': !scrolled 
        }"
        class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent dark:border-gray-800"
    >
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center bg-white border border-primary-200 dark:border-gray-700 group-hover:border-primary-400 transition">
                    <img 
                        src="{{ asset('images/logoKAL.png') }}" 
                        alt="PT Kurnia Agro Lestari" 
                        class="w-full h-full object-contain p-1"
                    >
                </div>
                <div class="leading-tight">
                    <h1 class="font-bold text-lg text-primary-900 dark:text-white">Kurnia Agro Lestari</h1>
                    <p class="text-[10px] text-secondary-600 dark:text-secondary-400 tracking-wider font-semibold">Solusi Pertanian</p>
                </div>
            </a>

            @php
                $navLinks = [
                    ['name' => 'Beranda', 'route' => 'home'],
                    ['name' => 'Tentang Kami', 'route' => 'about'],
                    ['name' => 'Produk', 'route' => 'products'],
                    ['name' => 'Solusi', 'route' => 'solutions'],
                    ['name' => 'Artikel', 'route' => 'articles'],
                    ['name' => 'Mitra', 'route' => 'partners'],
                ];
            @endphp

            <div class="hidden md:flex items-center space-x-8">
                @foreach($navLinks as $link)
                    @php $isActive = request()->routeIs($link['route']); @endphp
                    
                    <a href="{{ route($link['route']) }}" 
                       class="text-sm font-medium transition relative group {{ $isActive ? 'text-primary-600 dark:text-primary-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400' }}">
                        {{ $link['name'] }}
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-primary-500 dark:bg-primary-400 transition-all duration-300 {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-3">
                
                <button 
                    @click="toggleTheme()" 
                    class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition focus:outline-none"
                    title="Ganti Tema"
                >
                    <!-- SUN (Light Mode Icon) -->
                    <svg 
                        x-show="!darkMode"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v1m0 16v1m8-8h1M3 12H4m12.364-6.364l.707.707M6.343 17.657l.707.707m0-12.728l-.707.707m12.728 12.728l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>

                    <!-- MOON (Dark Mode Icon) -->
                    <svg 
                        x-show="darkMode"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3
                            7 7 0 0021 12.79z" />
                    </svg>
                </button>


                <a href="https://wa.me/6282171107777" target="_blank" class="hidden md:inline-flex px-5 py-2.5 bg-primary-500 text-white text-sm font-medium rounded-full shadow-lg shadow-primary-500/30 hover:bg-primary-600 hover:scale-105 transition-all transform">
                    Hubungi Kami
                </a>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 dark:text-gray-200 focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <div 
            x-show="mobileMenuOpen" 
            x-transition
            @click.away="mobileMenuOpen = false"
            class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 shadow-xl absolute w-full left-0"
            x-cloak
        >
            <div class="flex flex-col p-4 space-y-2">
                @foreach($navLinks as $link)
                    @php $isActive = request()->routeIs($link['route']); @endphp
                    <a href="{{ route($link['route']) }}" 
                       class="block px-4 py-2 rounded-lg font-medium transition {{ $isActive ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:text-primary-500 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        {{ $link['name'] }}
                    </a>
                @endforeach
                 <a href="https://wa.me/6282171107777" target="_blank" class="block mt-4 text-center px-4 py-2 bg-primary-500 text-white rounded-lg font-semibold">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </header>

    <main class="pt-20 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="bg-primary-950 dark:bg-gray-950 text-white pt-16 pb-8 border-t-4 border-secondary-500 transition-colors duration-300">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center bg-white border border-primary-200 dark:border-gray-700 group-hover:border-primary-400 transition">
                            <img 
                                src="{{ asset('images/logoKAL.png') }}" 
                                alt="PT Kurnia Agro Lestari" 
                                class="w-full h-full object-contain p-1"
                            >
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white">PT Kurnia Agro Lestari</span>
                    </div>
                    
                    <p class="text-gray-400 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        Mitra terbaik solusi pertanian Anda. Menyediakan pupuk berkualitas, teknologi drone, dan konsultasi ahli untuk hasil panen maksimal.
                    </p>
                    
                    <a 
                        href="{{ asset('documents/compro.pdf') }}" 
                        download="Company-Profile-PT-Kurnia-Agro-Lestari.pdf"
                        class="flex items-center mb-2 gap-2 text-secondary-400 hover:text-secondary-300 transition text-sm font-medium"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download Company Profile
                    </a>
                    <a 
                        href="{{ asset('documents/product_knowledge.pdf') }}" 
                        download="Product-Knowledge-PT-Kurnia-Agro-Lestari.pdf"
                        class="flex items-center gap-2 text-secondary-400 hover:text-secondary-300 transition text-sm font-medium"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download Product Knowladge
                    </a>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-secondary-500 mb-4">Perusahaan</h3>
                    <ul class="space-y-3 text-sm text-gray-400 dark:text-gray-400">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('products') }}" class="hover:text-white transition">Produk</a></li>
                        <li><a href="{{ route('solutions') }}" class="hover:text-white transition">Solusi</a></li>
                        <li><a href="{{ route('articles') }}" class="hover:text-white transition">Artikel & Berita</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-secondary-500 mb-4">Legalitas</h3>
                    <ul class="space-y-3 text-sm text-gray-400 dark:text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition">Sertifikasi & Izin</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-secondary-500 mb-4">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-400 dark:text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary-500 dark:text-primary-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Jl. Rawa Indah, Pekanbaru - RIAU<br>Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 821-7110-7777</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>muhammad221972@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-primary-900 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 dark:text-gray-500">
                <p>&copy; 2025 PT Kurnia Agro Lestari. All rights reserved.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Facebook</a>
                    <a href="#" class="hover:text-white transition">Instagram</a>
                    <a href="#" class="hover:text-white transition">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>