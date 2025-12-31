<div>
    <x-slot name="header">Halo, {{ $user['name'] }} 👋</x-slot>

    <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl p-6 text-white shadow-lg mb-6 relative overflow-hidden">
        <div class="relative z-10 flex justify-between items-center">
            <div>
                <p class="text-primary-100 text-sm">{{ $weather['loc'] }}</p>
                <h2 class="text-3xl font-bold mt-1">{{ $weather['temp'] }}°C</h2>
                <p class="text-sm mt-1">{{ $weather['desc'] }}</p>
            </div>
            <svg class="w-16 h-16 text-yellow-300 animate-pulse" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" /></svg>
        </div>
        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Luas</p>
            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['total_area'] }} <span class="text-xs font-normal">Ha</span></p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <p class="text-xs text-gray-500 dark:text-gray-400">Jadwal Pupuk</p>
            <p class="text-xl font-bold text-red-500">{{ $stats['next_schedule'] }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-gray-900 dark:text-white">Kebun Saya</h3>
        <a href="{{ route('client.garden') }}" class="text-xs text-primary-600 dark:text-primary-400 font-semibold">Lihat Semua</a>
    </div>

    <div class="space-y-4">
        @foreach($myGardens as $garden)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex gap-4 transition hover:bg-gray-50 dark:hover:bg-gray-700/50">
            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-lg bg-cover bg-center shrink-0" style="background-image: url('{{ $garden['image'] }}');"></div>
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white">{{ $garden['name'] }}</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $garden['type'] }} - {{ $garden['age'] }}</p>
                <div class="mt-2 flex gap-2">
                    <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] rounded font-bold">
                        {{ $garden['status'] }}
                    </span>
                    <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-[10px] rounded">
                        {{ $garden['area'] }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>