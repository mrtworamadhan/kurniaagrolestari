<div class="bg-white dark:bg-gray-900 min-h-screen pb-20 transition-colors duration-300">

    <section class="bg-primary-900 dark:bg-gray-950 pt-32 pb-20 -mt-20 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6">
                Setiap Lahan Punya <br> <span class="text-secondary-400">Cerita & Masalah Berbeda</span>
            </h1>
            <p class="text-primary-100 dark:text-gray-400 text-lg max-w-2xl mx-auto mb-8">
                Kami tidak sekadar menjual pupuk. Kami menganalisa masalah tanah Anda (Gambut, Pasir, Mineral) lalu memberikan formula yang tepat.
            </p>
        </div>
    </section>

    <section class="container mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    
                    <div class="bg-secondary-500 p-6 text-white">
                        <h2 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Kuesioner Kondisi Kebun
                        </h2>
                        <p class="text-secondary-100 text-sm mt-1">Data Anda aman. Kami akan menganalisa sebelum memberikan rekomendasi.</p>
                    </div>

                    <div class="p-8">
                        @if(!$isSubmitted)
                        <form wire:submit.prevent="submitForm" class="space-y-8">
                            
                            <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-primary-700 dark:text-primary-400 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Informasi Pemilik
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input wire:model="owner_name" type="text" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                        @error('owner_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">No. WhatsApp <span class="text-red-500">*</span></label>
                                        <input wire:model="phone" type="tel" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Email (Opsional)</label>
                                        <input wire:model="email" type="email" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Kota / Kabupaten</label>
                                        <input wire:model="city" type="text" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-primary-700 dark:text-primary-400 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Data Teknis Kebun
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold mb-2">Lokasi Kebun (Desa/Kecamatan)</label>
                                        <input wire:model="location" type="text" placeholder="Contoh: Desa Suka Maju, Kec. Tambusai" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Luas Lahan (Hektar) <span class="text-red-500">*</span></label>
                                        <input wire:model="area_size" type="number" step="0.1" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Jenis Tanaman</label>
                                        <select wire:model="plant_type" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                            <option value="Kelapa Sawit">Kelapa Sawit</option>
                                            <option value="Karet">Karet</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Usia Tanaman (Tahun) <span class="text-red-500">*</span></label>
                                        <input wire:model="plant_age" type="number" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Jenis Tanah <span class="text-red-500">*</span></label>
                                        <select wire:model="soil_type_id" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                            <option value="">-- Pilih Jenis Tanah --</option>
                                            @foreach($soilTypes as $soil)
                                                <option value="{{ $soil->id }}">{{ $soil->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('soil_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Topografi / Kontur</label>
                                        <select wire:model="topography" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                            <option value="Datar">Datar</option>
                                            <option value="Berbukit">Berbukit / Miring</option>
                                            <option value="Rawa">Rawa / Tergenang</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Varietas Bibit (Jika Tahu)</label>
                                        <input wire:model="plant_variety" type="text" placeholder="Contoh: PPKS, Socfindo, Marihat" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-primary-700 dark:text-primary-400 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                    Kondisi & Target
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Keluhan / Kondisi Saat Ini</label>
                                        <textarea wire:model="current_condition" rows="3" placeholder="Contoh: Daun menguning, buah trek, pelepah sengkleh..." class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Riwayat Pemupukan (6 Bulan Terakhir)</label>
                                        <textarea wire:model="fertilizer_history" rows="2" placeholder="Sebutkan jenis pupuk yang dipakai..." class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600"></textarea>
                                    </div>
                                    
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <div>
                                            <label class="block text-xs font-semibold mb-2">Berat Janjang Rata-rata (kg)</label>
                                            <input wire:model="bunch_weight" type="text" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold mb-2">Panen Saat Ini (Ton/Ha/Bln)</label>
                                            <input wire:model="current_yield" type="text" class="w-full px-4 py-2 rounded-lg border dark:bg-gray-800 dark:border-gray-600">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold mb-2 text-primary-600">Target Panen (Ton/Ha/Bln)</label>
                                            <input wire:model="target_yield" type="text" class="w-full px-4 py-2 bg-primary-50 dark:bg-primary-900/20 border border-primary-300 dark:border-primary-700 rounded-lg">
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label class="block text-sm font-semibold mb-2">Upload Foto Kondisi Kebun (Opsional)</label>
                                        <input wire:model="photos" type="file" multiple class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary-50 file:text-primary-700
                                        hover:file:bg-primary-100
                                        "/>
                                        <p class="text-xs text-gray-500 mt-1">Bisa pilih lebih dari 1 foto. Max 2MB per foto.</p>
                                        @error('photos.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" 
                                class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition transform active:scale-95 flex items-center justify-center gap-2 text-lg">
                                <svg wire:loading.remove class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span wire:loading.remove>Kirim Data Analisa</span>
                                <span wire:loading>Sedang Mengirim...</span>
                            </button>
                        </form>
                        
                        @else
                            <div class="text-center py-10" x-data x-init="$el.scrollIntoView({behavior: 'smooth', block: 'center'})">
                                <div class="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center text-green-600 dark:text-green-400 mx-auto mb-6 animate-bounce">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Permintaan Terkirim!</h3>
                                <p class="text-gray-600 dark:text-gray-300 max-w-md mx-auto mb-8">
                                    Terima kasih Bpk/Ibu <strong>{{ $owner_name }}</strong>. <br>
                                    Tim Agronomis kami telah menerima data kebun Anda. Kami akan menganalisa dan menghubungi Anda via WhatsApp di nomor <strong>{{ $phone }}</strong> dalam waktu 1x24 jam.
                                </p>
                                
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="{{ route('home') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        Kembali ke Beranda
                                    </a>
                                    <a href="https://wa.me/6282171107777" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center gap-2 shadow-lg shadow-green-600/30">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        Chat Admin Sekarang
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-secondary-100 dark:bg-secondary-900/30 rounded-lg flex items-center justify-center text-secondary-600 dark:text-secondary-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 dark:text-white">Teknis Sampel Tanah</h3>
                    </div>
                    <ul class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                        <li class="flex gap-3">
                            <span class="w-6 h-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-xs font-bold shrink-0">1</span>
                            <span>Ambil di <strong>5 Titik</strong>: Depan, Tengah, Belakang, Kiri, & Kanan lahan.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-6 h-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-xs font-bold shrink-0">2</span>
                            <span>Jarak ambil <strong>1 Meter</strong> dari batang pohon.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-6 h-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-xs font-bold shrink-0">3</span>
                            <span>Setiap titik ambil <strong>2 Sampel</strong>: <br>• 1/2 Kg dari permukaan (Top Soil) <br>• 1/2 Kg dari kedalaman 50cm</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-xl p-4 text-xs text-blue-800 dark:text-blue-300">
                    <p class="font-bold mb-1">Mengapa harus sedetail ini?</p>
                    <p>Agar analisa kami akurat. Pupuk yang tepat dosis & jenisnya akan menghemat biaya Anda hingga 40% dan meningkatkan panen secara nyata.</p>
                </div>
            </div>

        </div>
    </section>

    <section class="container mx-auto px-6 py-16">
        <div class="bg-primary-900 dark:bg-gray-950 rounded-3xl p-8 md:p-16 flex flex-col md:flex-row items-center gap-10 overflow-hidden relative">
             <div class="absolute top-0 right-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
             <div class="flex-1 relative z-10">
                <span class="bg-secondary-500 text-white text-xs font-bold px-3 py-1 rounded-full mb-4 inline-block">Coming Soon</span>
                <h2 class="text-3xl font-bold text-white mb-4">Rekam Medis Kebun Digital</h2>
                <p class="text-primary-100 dark:text-gray-400 text-lg mb-8">
                    Pantau riwayat kesehatan tanaman, jadwal pemupukan, dan grafik hasil panen kebun Anda dalam satu aplikasi terintegrasi. Teknologi pertama di Indonesia.
                </p>
                <button disabled class="bg-white/20 text-white border border-white/20 px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                    Segera Hadir
                </button>
            </div>
             <div class="flex-1 flex justify-center relative z-10">
                <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-4 border-gray-800 dark:border-gray-700 transform rotate-2 hover:rotate-0 transition duration-500 opacity-80">
                   <div class="bg-gray-800 p-3 flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    </div>
                    <div class="p-6 space-y-4 bg-gray-50 dark:bg-gray-900 flex items-center justify-center h-48">
                         <span class="text-gray-400 font-bold">Preview App Interface</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>