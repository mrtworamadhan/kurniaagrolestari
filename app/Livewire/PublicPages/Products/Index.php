<?php

namespace App\Livewire\PublicPages\Products;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Katalog Produk - PT Kurnia Agro Lestari')]
class Index extends Component
{
    #[Url] 
    public $category = 'Semua'; // Simpan status filter di URL
    
    #[Url]
    public $search = '';


    private function getProductData()
    {
        return [
            [
                'id' => 1,
                'name' => 'NITROGANIK',
                'category' => 'Semi Organik',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Urea Majemuk New Formula. Solusi cerdas perbaikan tanah & percepatan tumbuh.',
                'tags' => ['Best Seller', 'Vegetatif']
            ],
            [
                'id' => 2,
                'name' => 'NPK 6-12-22',
                'category' => 'Chemical Fertilizer',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Spesialis untuk tanaman perkebunan (Sawit/Karet) fase generatif.',
                'tags' => ['Sawit', 'Generatif']
            ],
            [
                'id' => 3,
                'name' => 'PHOSUL',
                'category' => 'Pembenah Tanah',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Pembenah tanah dengan kandungan Phosphate & Sulfur tinggi.',
                'tags' => ['Pembenah', 'Akar Kuat']
            ],
            [
                'id' => 4,
                'name' => 'CALCIUM GRANULAR',
                'category' => 'Nutrisi Makro',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Menetralkan pH tanah dan memperkuat dinding sel tanaman.',
                'tags' => ['pH Stabilizer', 'Anti Rontok']
            ],
            [
                'id' => 5,
                'name' => 'MAGSUL',
                'category' => 'Pembenah Tanah',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Kombinasi Magnesium & Sulfur untuk menghijaukan daun.',
                'tags' => ['Daun Hijau', 'Fotosintesis']
            ],
            [
                'id' => 6,
                'name' => 'NPK TRIPPLE 15',
                'category' => 'Chemical Fertilizer',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Pupuk seimbang untuk segala jenis tanaman pangan & hortikultura.',
                'tags' => ['Multiguna', 'Seimbang']
            ],
             [
                'id' => 7,
                'name' => 'CRP PAUS',
                'category' => 'Pembenah Tanah',
                'price' => 'Hubungi Kami',
                'image' => 'images/products/product.png',
                'desc' => 'Cepat Reaksi & Penyerapan. Teknologi baru pemupukan efisien.',
                'tags' => ['Teknologi Baru', 'Hemat']
            ],
        ];
    }

    public function render()
    {
        // Panggil data dari function private tadi
        $allProducts = $this->getProductData();

        // Logic Filter
        $filtered = collect($allProducts)
            ->filter(function ($item) {
                // Filter Category
                if ($this->category !== 'Semua' && $item['category'] !== $this->category) {
                    return false;
                }
                // Filter Search (Case Insensitive)
                if ($this->search !== '' && stripos($item['name'], $this->search) === false) {
                    return false;
                }
                return true;
            })->all();

        return view('livewire.public-pages.products.index', [
            'filteredProducts' => $filtered
        ]);
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
        $this->search = '';
    }
}