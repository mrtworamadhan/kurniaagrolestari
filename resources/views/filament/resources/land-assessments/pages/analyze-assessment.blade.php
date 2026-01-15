<x-filament-panels::page>

    {{ $this->infolist }}

    <div class="border-t border-gray-200 dark:border-white/10 my-6"></div>

    <form wire:submit="save">
        
        {{ $this->form }}

        <div class="mt-6 flex justify-end gap-3">
            <x-filament::button 
                color="gray" 
                tag="a" 
                :href="$this->getResource()::getUrl('index')"
            >
                Batal
            </x-filament::button>

            <x-filament::button 
                type="submit" 
                size="lg" 
                icon="heroicon-m-check-circle"
            >
                Simpan & Terbitkan Rekomendasi
            </x-filament::button>
        </div>
    </form>

</x-filament-panels::page>