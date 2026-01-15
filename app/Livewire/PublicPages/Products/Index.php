<?php

namespace App\Livewire\PublicPages\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('Katalog Produk - PT Kurnia Agro Lestari')]
class Index extends Component
{
    use WithPagination;

    #[Url] 
    public $category = 'Semua';
    
    #[Url]
    public $search = '';

    public function render()
    {
        $categories = Product::where('is_active', true)
            ->distinct()
            ->pluck('category') 
            ->prepend('Semua')
            ->toArray();

        $products = Product::where('is_active', true)
            ->when($this->category !== 'Semua', function ($q) {
                $q->where('category', $this->category);
            })
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(9); 

        return view('livewire.public-pages.products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
        $this->search = '';
        $this->resetPage(); 
    }
}