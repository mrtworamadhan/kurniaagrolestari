<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Profil Kebun - Client Area')]
#[Layout('components.layouts.client')]
class Garden extends Component
{
    public function render()
    {
        $gardens = \App\Models\Garden::with('soilType')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('livewire.client.garden', [
            'gardens' => $gardens
        ]);
    }
}