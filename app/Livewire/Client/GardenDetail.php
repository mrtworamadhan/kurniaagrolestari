<?php

namespace App\Livewire\Client;

use App\Models\Garden;
use App\Models\LandAssessment;
use App\Models\FertilizationRecord;
use App\Models\HarvestRecord;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Kebun')]
#[Layout('components.layouts.client')]
class GardenDetail extends Component
{
    use WithFileUploads;

    public $garden;
    public $initialAssessment;
    
    public $f_date, $f_name, $f_dosage, $f_unit = 'Kg/Pokok', $f_notes, $f_photo;
    
    public $h_date, $h_weight, $h_bunch, $h_notes;

    public $isFertilizerModalOpen = false;
    public $isHarvestModalOpen = false;

    public function mount($id)
    {
        $this->garden = Garden::with(['soilType'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $this->initialAssessment = LandAssessment::where('garden_id', $id)
            ->oldest()
            ->first();
            
        $this->f_date = date('Y-m-d');
        $this->h_date = date('Y-m-d');
    }

    public function saveFertilization()
    {
        $this->validate([
            'f_date' => 'required|date',
            'f_name' => 'required|string',
            'f_dosage' => 'required|numeric',
            'f_photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($this->f_photo) {
            $photoPath = $this->f_photo->store('fertilization-evidence', 'public');
        }

        FertilizationRecord::create([
            'garden_id' => $this->garden->id,
            'fertilization_date' => $this->f_date,
            'fertilizer_name' => $this->f_name,
            'dosage' => $this->f_dosage,
            'unit' => $this->f_unit,
            'notes' => $this->f_notes,
            'photo_evidence' => $photoPath,
        ]);

        $this->reset(['f_name', 'f_dosage', 'f_notes', 'f_photo']);
        $this->isFertilizerModalOpen = false; 
        
        session()->flash('message', 'Data pemupukan berhasil dicatat!');
    }

    public function saveHarvest()
    {
        $this->validate([
            'h_date' => 'required|date',
            'h_weight' => 'required|numeric',
            'h_bunch' => 'nullable|numeric',
        ]);

        HarvestRecord::create([
            'garden_id' => $this->garden->id,
            'harvest_date' => $this->h_date,
            'weight_kg' => $this->h_weight,
            'bunch_count' => $this->h_bunch,
            'notes' => $this->h_notes,
        ]);

        $this->reset(['h_weight', 'h_bunch', 'h_notes']);
        $this->isHarvestModalOpen = false;

        session()->flash('message', 'Data panen berhasil dicatat!');
    }

    public function render()
    {
        $fertilizationHistory = $this->garden->fertilizations()->latest('fertilization_date')->get();
        $harvestHistory = $this->garden->harvests()->latest('harvest_date')->get();

        return view('livewire.client.garden-detail', [
            'fertilizationHistory' => $fertilizationHistory,
            'harvestHistory' => $harvestHistory,
        ]);
    }
}