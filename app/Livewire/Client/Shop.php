<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Belanja - Client Area')]
#[Layout('components.layouts.client')]
class Shop extends Component
{
    public $search = '';
    public $category = 'Semua';

    // Data Produk sama persis dengan Home.php (Nanti dari DB)
    public function getProducts()
    {
        return [
            [
                'id' => 1,
                'name' => 'NITROGANIK',
                'category' => 'Semi Organik',
                'description' => 'Urea Majemuk New Formula. Mempercepat perbaikan tanah & pertumbuhan perakaran.',
                'image' => asset('images/products/product.png'), // Sesuaikan path asset
                'tags' => ['Best Seller', 'Tanah Gambut'],
                'price' => 'Hubungi Admin' // Di PWA mungkin ada harga khusus member
            ],
            [
                'id' => 2,
                'name' => 'NPK 6-12-22',
                'category' => 'Chemical Fertilizer',
                'description' => 'Pupuk non-subsidi untuk perkebunan dengan formulasi presisi untuk hasil maksimal.',
                'image' => asset('images/products/product.png'),
                'tags' => ['Sawit', 'Karet'],
                'price' => 'Hubungi Admin'
            ],
            [
                'id' => 3,
                'name' => 'PHOSUL',
                'category' => 'Pembenah Tanah',
                'description' => 'Pupuk perbaikan tanah, pertumbuhan batang, serta menstabilkan pembuahan.',
                'image' => asset('images/products/product.png'),
                'tags' => ['Pembenah Tanah', 'Efektif'],
                'price' => 'Hubungi Admin'
            ],
            [
                'id' => 4,
                'name' => 'CALCIUM GRANULAR',
                'category' => 'Nutrisi Makro',
                'description' => 'Menstabilkan pH tanah, perbanyakan nutrisi, dan pembesaran buah.',
                'image' => asset('images/products/product.png'),
                'tags' => ['pH Stabilizer', 'Buah Besar'],
                'price' => 'Hubungi Admin'
            ],
        ];
    }

    public function render()
    {
        $products = collect($this->getProducts())
            ->filter(function ($item) {
                // Filter Search
                if ($this->search !== '' && stripos($item['name'], $this->search) === false) {
                    return false;
                }
                // Filter Category
                if ($this->category !== 'Semua' && $item['category'] !== $this->category) {
                    return false;
                }
                return true;
            });

        return view('livewire.client.shop', [
            'products' => $products
        ]);
    }
    
    public function setCategory($cat)
    {
        $this->category = $cat;
    }
}