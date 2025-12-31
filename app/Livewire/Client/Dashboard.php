<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Dashboard - Client Area')]
#[Layout('components.layouts.client')] // Pakai layout khusus PWA
class Dashboard extends Component
{
    public $user;
    public $stats;
    public $weather;
    public $myGardens = [];

    public function mount()
    {
        // Simulasi Auth User
        $this->user = ['name' => 'Pak Budi'];

        // Simulasi Statistik
        $this->stats = [
            'total_area' => 12, // Hektar
            'next_schedule' => '2 Hari Lagi', // Jadwal pupuk
        ];

        // Simulasi Cuaca
        $this->weather = [
            'temp' => 32,
            'desc' => 'Cerah Berawan',
            'loc' => 'Rokan Hilir, Riau'
        ];

        // Simulasi List Kebun (Ringkasan)
        $this->myGardens = [
            [
                'id' => 1,
                'name' => 'Kebun Blok A (Gambut)',
                'type' => 'Sawit',
                'age' => '8 Tahun',
                'area' => '4 Ha',
                'status' => 'Sehat',
                'image' => 'https://images.unsplash.com/photo-1625246333195-58f2164be23e?q=80&w=200&auto=format&fit=crop'
            ],
            // Bisa tambah lagi
        ];
    }

    public function render()
    {
        return view('livewire.client.dashboard');
    }
}