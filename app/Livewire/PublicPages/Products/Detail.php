<?php

namespace App\Livewire\PublicPages\Products;

use App\Models\Product;
use Livewire\Component;

class Detail extends Component
{
    public $product;
    public $relatedProducts = [];

    public function title()
    {
        return $this->product->name . ' - PT Kurnia Agro Lestari';
    }

    public function mount($id)
    {
        $this->product = Product::where('is_active', true)->findOrFail($id);

        $this->relatedProducts = Product::where('is_active', true)
            ->where('category', $this->product->category)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.public-pages.products.detail');
    }
}