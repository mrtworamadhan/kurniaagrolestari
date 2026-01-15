<?php

namespace App\Livewire\Client;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Produk')]
#[Layout('components.layouts.client')]
class ProductDetail extends Component
{
    public $product;
    public $relatedProducts = [];

    public function mount($id)
    {
        $this->product = Product::where('is_active', true)->findOrFail($id);

        $this->relatedProducts = Product::where('is_active', true)
            ->where('category', $this->product->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.client.product-detail');
    }
}