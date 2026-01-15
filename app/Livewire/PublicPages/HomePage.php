<?php

namespace App\Livewire\PublicPages;

use App\Models\Product;
use App\Models\Testimonial;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Beranda - PT Kurnia Agro Lestari')]
class HomePage extends Component
{
    public $products = [];
    public $testimonials = [];
    public $stats = [];

    public function mount()
    {
        $this->products = Product::where('is_active', true)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category->name ?? 'Umum', 
                    'description' => $product->description,
                    'image' => $product->image 
                        ? asset('storage/' . $product->image) 
                        : asset('images/products/product-placeholder.png'),
                    'tags' => ['Unggulan', 'Terlaris'], 
                ];
            });

        $this->testimonials = Testimonial::where('is_active', true)
            ->where('rating', '>=', 4) 
            ->inRandomOrder() 
            ->take(5)
            ->get()
            ->map(function ($testi) {
                return [
                    'name' => $testi->name,
                    'role' => $testi->role ?? 'Mitra Petani',
                    'location' => 'Indonesia', 
                    'content' => $testi->content,
                    'product' => 'Pupuk PT KAL', 
                    'avatar' => $testi->avatar 
                        ? asset('storage/' . $testi->avatar) 
                        : null, 
                ];
            });

        $this->stats = [
            ['label' => 'Jenis Produk', 'value' => Product::where('is_active', true)->count() . '+', 'desc' => 'Formula Teruji'],
            ['label' => 'Pengalaman', 'value' => '25+', 'desc' => 'Tahun di Agrikultur'],
            ['label' => 'Peningkatan Hasil', 'value' => '70%', 'desc' => 'Target Kenaikan Panen'],
        ];
    }

    public function render()
    {
        return view('livewire.public-pages.home');
    }
}