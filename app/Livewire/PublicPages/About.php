<?php

namespace App\Livewire\PublicPages;

use App\Models\CompanyDocument;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tentang Kami - PT Kurnia Agro Lestari')]
class About extends Component
{
    public $certifications = [];

    public function mount()
    {
        $documents = CompanyDocument::all();

        if ($documents->isNotEmpty()) {
            $this->certifications = $documents->map(function ($doc) {
                return [
                    'title'  => $doc->name,
                    'desc'   => $doc->description ?? 'Dokumen Resmi PT KAL',
                    'number' => $doc->document_number ?? '-',
                    'file'   => $doc->file_path ? asset('storage/' . $doc->file_path) : null,
                    'icon'   => $this->getIconForDocument($doc->name),
                ];
            });
        } else {
            $this->certifications = [
                [
                    'title' => 'Izin Edar Kementan',
                    'desc' => 'Terdaftar resmi di Kementerian Pertanian RI',
                    'number' => 'No. Pendaftaran: 01.02.2023.1084',
                    'icon' => 'heroicon-s-document-check',
                    'file' => null
                ],
                [
                    'title' => 'Uji Mutu Laboratorium',
                    'desc' => 'Lulus uji Central Plantation Service & Sucofindo',
                    'number' => 'Standard: SNI / Non-SNI Teruji',
                    'icon' => 'heroicon-s-beaker',
                    'file' => null
                ],
            ];
        }
    }

    private function getIconForDocument($name)
    {
        $name = strtolower($name);
        if (str_contains($name, 'lab') || str_contains($name, 'mutu')) return 'heroicon-s-beaker';
        if (str_contains($name, 'haki') || str_contains($name, 'merek')) return 'heroicon-s-shield-check';
        if (str_contains($name, 'izin') || str_contains($name, 'edar')) return 'heroicon-s-document-check';
        
        return 'heroicon-s-check-badge';
    }

    public function render()
    {
        return view('livewire.public-pages.about');
    }
}