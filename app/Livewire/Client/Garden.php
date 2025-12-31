<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Profil Kebun - Client Area')]
#[Layout('components.layouts.client')]
class Garden extends Component
{
    public function getGardens()
    {
        // Simulasi DB
        return [
            [
                'id' => 1,
                'name' => 'Blok A (Gambut)',
                'location' => 'Rokan Hilir, Riau',
                'area' => '4 Ha',
                'soil_type' => 'Gambut',
                'plant_age' => '8 Th',
                'image' => 'https://images.unsplash.com/photo-1625246333195-58f2164be23e?q=80'
            ],
            [
                'id' => 2,
                'name' => 'Blok B (Pasir)',
                'location' => 'Dumai, Riau',
                'area' => '2 Ha',
                'soil_type' => 'Pasir',
                'plant_age' => '4 Th',
                'image' => 'https://images.unsplash.com/photo-1598155523122-38423bd4d6bc?q=80'
            ],
            // Tambah data dummy lain
        ];
    }

    public function render()
    {
        return view('livewire.client.garden', [
            'gardens' => $this->getGardens()
        ]);
    }
}