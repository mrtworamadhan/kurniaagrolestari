<?php

namespace App\Livewire\PublicPages\Products;

use Livewire\Component;
use Livewire\Attributes\Title;

class Detail extends Component
{
    public $product;
    public $relatedProducts = [];

    // Set Title halaman dinamis sesuai nama produk
    public function title()
    {
        return $this->product['name'] . ' - PT Kurnia Agro Lestari';
    }

    public function mount($id)
    {
        // Simulasi Database (Data Lengkap)
        $allProducts = [
            [
                'id' => 1,
                'name' => 'NITROGANIK',
                'category' => 'Semi Organik',
                'image' => 'images/products/product.png',
                'price' => 'Hubungi Kami',
                'short_desc' => 'Urea Majemuk New Formula. Solusi cerdas perbaikan tanah & percepatan tumbuh.',
                'description' => 'NITROGANIK adalah terobosan pupuk urea majemuk semi-organik. Diformulasikan khusus untuk memperbaiki tanah yang keras akibat residu kimia, sekaligus memacu pertumbuhan vegetatif (daun & batang) dengan sangat cepat.',
                'specs' => [
                    ['name' => 'Nitrogen (N)', 'value' => '18%'],
                    ['name' => 'Phosphate (P)', 'value' => '2%'],
                    ['name' => 'Kalium (K)', 'value' => '2%'],
                    ['name' => 'Bahan Organik', 'value' => '15%'],
                    ['name' => 'Bentuk', 'value' => 'Granul Coklat'],
                ],
                'usage' => 'Tabur merata di piringan tanaman. Dosis: 0.5 - 1 Kg per pokok untuk tanaman TBM (Tanaman Belum Menghasilkan).',
                'tags' => ['Vegetatif', 'Tanah Rusak']
            ],
            [
                'id' => 2,
                'name' => 'NPK 6-12-22',
                'category' => 'Chemical Fertilizer',
                'image' => 'images/products/product.png',
                'price' => 'Hubungi Kami',
                'short_desc' => 'Spesialis untuk tanaman perkebunan (Sawit/Karet) fase generatif.',
                'description' => 'Pupuk NPK Formulasi khusus dengan Kalium tinggi. Sangat cocok untuk tanaman kelapa sawit yang sudah masuk masa produktif (TM) untuk memaksimalkan berat janjang dan rendemen minyak.',
                'specs' => [
                    ['name' => 'Nitrogen (N)', 'value' => '6%'],
                    ['name' => 'Phosphate (P)', 'value' => '12%'],
                    ['name' => 'Kalium (K)', 'value' => '22%'],
                    ['name' => 'Magnesium (MgO)', 'value' => '3%'],
                    ['name' => 'Bentuk', 'value' => 'Granul Merah Bata'],
                ],
                'usage' => 'Dosis 2 - 2.5 Kg per pokok per semester (6 bulan sekali). Aplikasikan saat kondisi tanah lembab.',
                'tags' => ['Generatif', 'Buah Besar']
            ],
            // ... Tambahkan data lain jika perlu, atau gunakan default fallback
        ];

        // Cari Produk berdasarkan ID
        $this->product = collect($allProducts)->firstWhere('id', $id);

        // Jika tidak ketemu (misal ID 999), redirect balik atau error 404
        if (!$this->product) {
            return redirect()->route('products');
        }

        // Ambil produk lain untuk "Related Products" (acak)
        $this->relatedProducts = collect($allProducts)
            ->where('id', '!=', $id)
            ->take(3)
            ->all();
    }

    public function render()
    {
        return view('livewire.public-pages.products.detail');
    }
}
