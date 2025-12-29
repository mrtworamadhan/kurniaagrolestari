<?php

namespace App\Livewire\PublicPages;

use Livewire\Component;

#[Title('Beranda - PT Kurnia Agro Lestari')]

class HomePage extends Component
{
    public $products = [];
    public $testimonials = [];
    public $stats = [];

    public function mount()
    {
        // Data Dummy Produk (Berdasarkan PDF)
        $this->products = [
            [
                'id' => 1,
                'name' => 'NITROGANIK',
                'category' => 'Semi Organik',
                'description' => 'Urea Majemuk New Formula. Mempercepat perbaikan tanah & pertumbuhan perakaran.',
                'image' => 'images/products/product.png', // Nanti diganti real image
                'tags' => ['Best Seller', 'Tanah Gambut'],
            ],
            [
                'id' => 2,
                'name' => 'NPK 6-12-22',
                'category' => 'Chemical Fertilizer',
                'description' => 'Pupuk non-subsidi untuk perkebunan dengan formulasi presisi untuk hasil maksimal.',
                'image' => 'images/products/product.png',
                'tags' => ['Sawit', 'Karet'],
            ],
            [
                'id' => 3,
                'name' => 'PHOSUL',
                'category' => 'Pembenah Tanah',
                'description' => 'Pupuk perbaikan tanah, pertumbuhan batang, serta menstabilkan pembuahan.',
                'image' => 'images/products/product.png',
                'tags' => ['Pembenah Tanah', 'Efektif'],
            ],
            [
                'id' => 4,
                'name' => 'CALCIUM GRANULAR',
                'category' => 'Nutrisi Makro',
                'description' => 'Menstabilkan pH tanah, perbanyakan nutrisi, dan pembesaran buah.',
                'image' => 'images/products/product.png',
                'tags' => ['pH Stabilizer', 'Buah Besar'],
            ],
        ];

        // Data Dummy Testimoni (Berdasarkan PDF Page 28-29)
        $this->testimonials = [
            [
                'name' => 'Bpk. Ramli',
                'role' => 'Petani Sawit',
                'location' => 'Riau',
                'content' => 'Alhamdulillah, dengan pemupukan 4x setahun, hasil panen normal 1 s.d 1.2 ton/Ha/sekali panen, dan TIDAK PERNAH TREK LAGI.',
                'product' => 'Nitroganik & Magsul',
            ],
            [
                'name' => 'Bpk. Togatorup',
                'role' => 'Pemilik Kebun',
                'location' => 'Rokan Hilir',
                'content' => 'Perbandingan hasil panen di lahan gambut sangat nyata. Blok pupuk KAL menghasilkan 2.345 Kg dibanding pupuk umum yang hanya 1.500 Kg.',
                'product' => 'Paket Lengkap PT KAL',
            ],
            [
                'name' => 'Ibu Tien',
                'role' => 'Pemilik Lahan',
                'location' => 'Lahan Gambut Kering',
                'content' => 'Hanya butuh waktu 7 bulan untuk memulihkan kebun dan mulai menghasilkan. Kalau pakai pupuk lain butuh 3-4 tahun.',
                'product' => 'CRP Paus & Phosul',
            ],
        ];

        // Statistik
        $this->stats = [
            ['label' => 'Jenis Produk', 'value' => '17+', 'desc' => 'Formula Teruji'],
            ['label' => 'Pengalaman', 'value' => '25+', 'desc' => 'Tahun di Agrikultur'], // Berdasarkan Profile Muhammad Hasyari (1996-Now)
            ['label' => 'Peningkatan Hasil', 'value' => '70%', 'desc' => 'Target Kenaikan Panen'], // Berdasarkan PDF Page 2
        ];
    }

    public function render()
    {
        return view('livewire.public-pages.home');
    }
}
