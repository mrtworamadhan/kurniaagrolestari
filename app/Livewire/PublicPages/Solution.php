<?php

namespace App\Livewire\PublicPages;

use App\Models\LandAnalysisRequest;
use App\Models\SoilType; // Pastikan model SoilType ada
use Livewire\Component;
use Livewire\WithFileUploads; // Penting buat upload foto
use Livewire\Attributes\Title;

#[Title('Solusi Pertanian - PT Kurnia Agro Lestari')]
class Solution extends Component
{
    use WithFileUploads;

    // Data Diri
    public $owner_name, $phone, $email, $address, $city;
    
    // Data Kebun
    public $location, $area_size, $plant_type = 'Kelapa Sawit', $plant_age;
    public $soil_type_id, $coordinates;
    
    // Masalah & Target
    public $plant_variety, $topography = 'Datar', $current_condition;
    public $fertilizer_history, $bunch_weight;
    public $current_yield, $target_yield;
    
    // Media
    public $photos = [];
    
    public $isSubmitted = false;

    // Load Data Master (Jenis Tanah)
    public $soilTypes = [];

    public function mount()
    {
        $this->soilTypes = SoilType::all(); 
    }

    protected $rules = [
        'owner_name' => 'required|min:3',
        'phone' => 'required|numeric|min:10',
        'area_size' => 'required|numeric',
        'plant_age' => 'required|numeric',
        'soil_type_id' => 'required',
        'photos.*' => 'image|max:2048', 
    ];

    public function submitForm()
    {
        $this->validate();

        $photoPaths = [];
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $photoPaths[] = $photo->store('requests-photos', 'public');
            }
        }

        LandAnalysisRequest::create([
            'owner_name' => $this->owner_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            
            'location' => $this->location,
            'area_size' => $this->area_size,
            'plant_type' => $this->plant_type,
            'plant_age' => $this->plant_age,
            'soil_type_id' => $this->soil_type_id, 
            'coordinates' => $this->coordinates,
            
            'plant_variety' => $this->plant_variety,
            'topography' => $this->topography,
            'current_condition' => $this->current_condition,
            'fertilizer_history' => $this->fertilizer_history,
            'bunch_weight' => $this->bunch_weight,
            
            'current_yield' => $this->current_yield,
            'target_yield' => $this->target_yield,
            
            'photos' => $photoPaths,
        ]);

        $this->isSubmitted = true;
        $this->resetExcept('isSubmitted', 'soilTypes');
    }

    public function render()
    {
        return view('livewire.public-pages.solution');
    }
}