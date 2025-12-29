<?php

namespace App\Livewire\PublicPages;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Solusi Pertanian - PT Kurnia Agro Lestari')]

class Solution extends Component
{
    public function render()
    {
        return view('livewire.public-pages.solution');
    }
}
