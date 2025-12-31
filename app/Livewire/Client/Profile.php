<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Profil Saya - Client Area')]
#[Layout('components.layouts.client')]
class Profile extends Component
{
    public $user;

    public function mount()
    {
        // Simulasi Auth User
        $this->user = [
            'name' => 'Budi Santoso',
            'email' => 'budisantoso@gmail.com',
            'phone' => '081234567890',
            'location' => 'Rokan Hilir, Riau',
            'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=22c55e&color=fff',
            'joined' => 'Client sejak 2023'
        ];
    }

    public function logout()
    {
        // Nanti logic logout Laravel auth
        // Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.client.profile');
    }
}