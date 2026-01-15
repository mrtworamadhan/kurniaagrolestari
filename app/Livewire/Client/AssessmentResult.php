<?php

namespace App\Livewire\Client;

use App\Models\LandAssessment;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Hasil Analisa Kebun')]
#[Layout('components.layouts.client')]
class AssessmentResult extends Component
{
    public $assessment;
    public $recommendations = []; 

    public function mount($id)
    {
        $this->assessment = LandAssessment::with(['garden', 'labResult', 'recommendation'])
            ->whereHas('garden', function($q) {
                $q->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        if ($this->assessment->status !== 'completed') {
            return redirect()->route('client.garden.detail', $this->assessment->garden_id);
        }

        if ($this->assessment->recommendation && !empty($this->assessment->recommendation->product_recommendations)) {
            
            $rawRecs = $this->assessment->recommendation->product_recommendations;
            
            $productIds = collect($rawRecs)->pluck('product_id')->toArray();
            
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            foreach ($rawRecs as $rec) {
                if (isset($products[$rec['product_id']])) {
                    $this->recommendations[] = [
                        'product' => $products[$rec['product_id']], 
                        'dosage' => $rec['dosage'] ?? '-',
                        'frequency' => $rec['frequency'] ?? '-',
                    ];
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.client.assessment-result');
    }
}