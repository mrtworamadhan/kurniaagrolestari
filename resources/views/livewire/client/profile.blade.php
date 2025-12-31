<div>
    <x-slot name="header">Profil Saya</x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex items-center gap-4 mb-6">
        <img src="{{ $user['avatar'] }}" class="w-16 h-16 rounded-full border-2 border-primary-500 p-0.5">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user['name'] }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user['phone'] }}</p>
            <span class="inline-block mt-1 px-2 py-0.5 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 text-xs rounded-md font-medium">
                {{ $user['joined'] }}
            </span>
        </div>
    </div>

    <div class="space-y-4">
        
        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-gray-900 dark:text-white text-sm">Informasi Akun</h3>
            </div>
            <div class="p-4 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Email</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user['email'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Lokasi</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user['location'] }}</span>
                </div>
                <button class="w-full py-2 mt-2 text-sm text-primary-600 dark:text-primary-400 font-medium bg-primary-50 dark:bg-primary-900/10 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/20 transition">
                    Edit Profil
                </button>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Notifikasi</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Riwayat Pesanan</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>

            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Bantuan & Support</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <button wire:click="logout" class="w-full py-3 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-bold text-sm rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar Aplikasi
        </button>

        <p class="text-center text-xs text-gray-400 mt-6">Versi Aplikasi 1.0.0</p>
    </div>
</div>