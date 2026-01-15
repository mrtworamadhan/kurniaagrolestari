<?php

namespace App\Livewire\Client;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Belanja - Client Area')]
#[Layout('components.layouts.client')]
class Shop extends Component
{
    public $search = '';
    public $category = 'Semua';
    public $categories = []; 

    public function mount()
    {
        $dbCategories = Product::where('is_active', true)
            ->select('category')
            ->distinct() 
            ->pluck('category')
            ->toArray();

        $this->categories = array_merge(['Semua'], $dbCategories);
    }

    public function render()
    {
        $products = Product::where('is_active', true)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category !== 'Semua', function ($query) {
                $query->where('category', $this->category);
            })
            ->latest()
            ->get();

        return view('livewire.client.shop', [
            'products' => $products
        ]);
    }
    
    public function setCategory($cat)
    {
        $this->category = $cat;
    }
}