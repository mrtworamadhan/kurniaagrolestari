<!DOCTYPE html>
<html lang="id" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> <meta name="theme-color" content="#22c55e"> <title>{{ $title ?? 'Client Area - PT KAL' }}</title>
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

    <link rel="manifest" href="/manifest.json">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50 dark:bg-gray-900 dark:text-gray-100 pb-24"> 
    <header class="fixed top-0 w-full z-40 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 px-6 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center bg-white border border-primary-200 dark:border-gray-700 group-hover:border-primary-400 transition">
                    <img 
                        src="{{ asset('images/logoKAL.png') }}" 
                        alt="PT Kurnia Agro Lestari" 
                        class="w-full h-full object-contain p-1"
                    >
                </div>
            <h1 class="font-bold text-lg text-gray-900 dark:text-white truncate">{{ $header ?? 'Dashboard' }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark')" class="text-gray-500 dark:text-gray-400">
                <svg x-show="!darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8-8h1M3 12H4m12.364-6.364l.707.707M6.343 17.657l.707.707m0-12.728l-.707.707m12.728 12.728l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                <svg x-show="darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>
            </button>
            <button class="relative text-gray-500 dark:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white dark:ring-gray-900 bg-red-500"></span>
            </button>
        </div>
    </header>

    <main class="pt-20 px-4 container mx-auto max-w-md"> 
        {{ $slot }}
    </main>

    <nav class="fixed bottom-0 left-0 w-full bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 z-50 pb-safe">
        <div class="flex justify-around items-center h-16 max-w-md mx-auto">
            
            <a href="/client/dashboard" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->is('client/dashboard') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>

            <a href="/client/kebun" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->is('client/kebun*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-[10px] font-medium">Kebun</span>
            </a>

            <div class="relative -top-5">
                <a href="/client/rekam-medis" class="flex items-center justify-center w-14 h-14 rounded-full bg-primary-500 text-white shadow-lg shadow-primary-500/40 border-4 border-gray-50 dark:border-gray-900 transform active:scale-95 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </a>
            </div>

            <a href="/client/produk" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->is('client/produk*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="text-[10px] font-medium">Belanja</span>
            </a>

            <a href="/client/profil" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->is('client/profil') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-[10px] font-medium">Akun</span>
            </a>
        </div>
    </nav>
</body>
</html>