<?php

namespace App\Livewire\PublicPages;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tentang Kami - PT Kurnia Agro Lestari')]
class About extends Component
{
    public $certifications = [];

    public function mount()
    {
        $this->certifications = [
            [
                'title' => 'Izin Edar Kementan',
                'desc' => 'Terdaftar resmi di Kementerian Pertanian RI',
                'number' => 'No. Pendaftaran: 01.02.2023.1084', // Contoh format dari PDF
                'icon' => 'heroicon-s-document-check'
            ],
            [
                'title' => 'Uji Mutu Laboratorium',
                'desc' => 'Lulus uji Central Plantation Service & Sucofindo',
                'number' => 'Standard: SNI / Non-SNI Teruji',
                'icon' => 'heroicon-s-beaker'
            ],
            [
                'title' => 'Komite Akreditasi Nasional',
                'desc' => 'Hasil uji valid oleh laboratorium terakreditasi KAN',
                'number' => 'Validitas Tinggi',
                'icon' => 'heroicon-s-check-badge'
            ],
            [
                'title' => 'Hak Kekayaan Intelektual',
                'desc' => 'Merek Dagang Terdaftar di DJKI',
                'number' => 'Did2024124060', // [cite: 861]
                'icon' => 'heroicon-s-shield-check'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.public-pages.about');
    }
}