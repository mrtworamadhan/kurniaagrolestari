<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Rekam Medis - Client Area')]
#[Layout('components.layouts.client')]
class Record extends Component
{
    public $filter = 'all'; // Untuk filter kebun nanti

    public function getRecords()
    {
        return [
            [
                'date' => '12 Mar 2025',
                'type' => 'treatment', // treatment, issue, harvest
                'title' => 'Aplikasi NITROGANIK',
                'desc' => 'Dosis 1 Kg/Pokok. Kondisi tanah lembab pasca hujan.',
                'images' => ['https://via.placeholder.com/100', 'https://via.placeholder.com/100']
            ],
            [
                'date' => '20 Feb 2025',
                'type' => 'issue',
                'title' => 'Daun Menguning (Defisiensi Mg)',
                'desc' => 'Ditemukan di 15 pokok bagian selatan.',
                'badge' => 'Perlu Tindakan'
            ],
            [
                'date' => '10 Jan 2025',
                'type' => 'harvest',
                'title' => 'Panen Rotasi 1',
                'stats' => [
                    ['label' => 'Total Berat', 'value' => '1.2 Ton'],
                    ['label' => 'BJR', 'value' => '18 Kg'],
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.client.record', [
            'records' => $this->getRecords()
        ]);
    }
}