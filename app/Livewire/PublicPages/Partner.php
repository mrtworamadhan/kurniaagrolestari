<?php

namespace App\Livewire\PublicPages;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Mitra & Kontak - PT Kurnia Agro Lestari')]
class Partner extends Component
{
    // Form Properties
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|numeric|min_digits:10')]
    public $phone = '';

    #[Validate('required')]
    public $city = '';

    #[Validate('required|min:10')]
    public $message = '';
    

    public function save()
    {
        $this->validate();

        // Simulasi kirim data (Nanti disini logic simpan ke DB / Kirim Email)
        sleep(1); // Ceritanya loading sebentar

        // Reset form & kirim notifikasi sukses
        $this->reset();
        session()->flash('success', 'Terima kasih! Permintaan kemitraan Anda telah kami terima. Tim kami akan menghubungi Anda via WhatsApp.');
    }

    public function render()
    {
        return view('livewire.public-pages.partner');
    }
}
