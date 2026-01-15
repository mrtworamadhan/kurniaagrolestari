<?php

namespace App\Livewire\Client;

use App\Models\Garden;
use App\Models\LandAssessment;
use App\Models\SoilType;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Title('Tambah Kebun Baru')]
#[Layout('components.layouts.client')]
class GardenAdd extends Component
{
    use WithFileUploads;

    public $location, $area_size, $plant_type = 'Kelapa Sawit', $plant_age, $coordinates;
    public $soil_type_id;
    
    public $plant_variety, $topography = 'Datar';
    public $current_condition, $fertilizer_history, $bunch_weight;
    public $current_yield, $target_yield;
    
    public $photos = [];
    public $soilTypes = [];

    public function mount()
    {
        $this->soilTypes = SoilType::all();
    }

    protected $rules = [
        'location' => 'required',
        'area_size' => 'required|numeric',
        'plant_age' => 'required|numeric',
        'soil_type_id' => 'required',
        'photos.*' => 'image|max:5120',
    ];

    public function save()
    {
        $this->validate();

        $photoPaths = [];
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $photoPaths[] = $photo->store('gardens', 'public');
            }
        }

        DB::transaction(function () use ($photoPaths) {
            $garden = Garden::create([
                'user_id' => auth()->id(),
                'name' => 'Kebun ' . $this->location,
                'address' => $this->location, 
                'area_size' => $this->area_size,
                'plant_type' => $this->plant_type,
                'plant_age' => $this->plant_age,
                'soil_type_id' => $this->soil_type_id,
                'coordinates' => $this->coordinates,
                'photo' => $photoPaths[0] ?? null,
            ]);

            LandAssessment::create([
                'garden_id' => $garden->id,
                'assessment_date' => now(),
                'plant_variety' => $this->plant_variety,
                'topography' => $this->topography,
                'notes' => $this->current_condition, 
                'history_notes' => $this->fertilizer_history,
                'bunch_weight' => $this->bunch_weight,
                'current_yield' => $this->current_yield,
                'target_yield' => $this->target_yield,
                'visual_evidence' => $photoPaths, 
                'status' => 'pending', 
            ]);
        });

        session()->flash('message', 'Kebun berhasil ditambahkan! Tim kami akan segera menganalisanya.');
        return redirect()->route('client.garden');
    }

    public function render()
    {
        return view('livewire.client.garden-add');
    }
}