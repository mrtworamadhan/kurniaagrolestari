<div>
    <x-slot name="header">Rekam Medis Kebun</x-slot>

    <div class="mb-6 overflow-x-auto pb-2 flex gap-2 hide-scrollbar">
        <button class="px-4 py-2 bg-primary-600 text-white rounded-full text-sm font-bold whitespace-nowrap shadow-md">Semua Kebun</button>
        <button class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-gray-50 dark:hover:bg-gray-700">Blok A (Gambut)</button>
        <button class="px-4 py-2 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-gray-50 dark:hover:bg-gray-700">Blok B (Pasir)</button>
    </div>

    <div class="relative border-l-2 border-gray-200 dark:border-gray-700 ml-3 space-y-8 pb-10">
        
        @foreach($records as $record)
        <div class="relative pl-8">
            @php
                $dotColor = match($record['type']) {
                    'treatment' => 'bg-green-500',
                    'issue' => 'bg-yellow-500',
                    'harvest' => 'bg-blue-500',
                    default => 'bg-gray-500'
                };
            @endphp
            
            <div class="absolute -left-[9px] top-0 w-5 h-5 rounded-full {{ $dotColor }} border-4 border-white dark:border-gray-900 shadow-sm"></div>
            
            <span class="text-xs text-gray-400 dark:text-gray-500 mb-1 block font-medium">
                {{ $record['date'] }} • 
                <span class="uppercase">{{ $record['type'] }}</span>
            </span>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition">
                <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $record['title'] }}</h4>
                
                @if(isset($record['desc']))
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 leading-relaxed">{{ $record['desc'] }}</p>
                @endif

                @if(isset($record['badge']))
                    <span class="inline-block px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs rounded font-bold mb-2">
                        {{ $record['badge'] }}
                    </span>
                @endif

                @if(isset($record['images']))
                <div class="flex gap-2 overflow-x-auto pb-1">
                    @foreach($record['images'] as $img)
                        <img src="{{ $img }}" class="w-16 h-16 rounded-lg object-cover border border-gray-200 dark:border-gray-600 shrink-0">
                    @endforeach
                </div>
                @endif

                @if(isset($record['stats']))
                <div class="flex items-center gap-6 mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                    @foreach($record['stats'] as $stat)
                    <div>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $stat['label'] }}</p>
                        <p class="font-bold text-primary-600 dark:text-primary-400">{{ $stat['value'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach

    </div>
</div>