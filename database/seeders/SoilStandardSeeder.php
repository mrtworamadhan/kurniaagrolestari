<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoilStandard;

class SoilStandardSeeder extends Seeder
{
    public function run(): void
    {
        $berpasir = \App\Models\SoilType::create(['name' => 'Berpasir', 'description' => 'Tanah Berpasir']);
        $gambut = \App\Models\SoilType::create(['name' => 'Gambut', 'description' => 'Lahan basah organic']);
        $darat = \App\Models\SoilType::create(['name' => 'Darat', 'description' => 'Tanah Darat']);

        SoilStandard::create([
            'plant_type' => 'Sawit',
            'soil_type_id' => $berpasir->id,
            'standard_values' => [
                'ph_level'    => 6.0, 
                'c_organic'   => 1.5, 
                'ktk'         => 12.0,

                'n_total'     => 0.15, 
                'p_available' => 15.0, 
                'k_exchange'  => 0.25,
                'mg_exchange' => 0.30,
                'ca_exchange' => 2.00, 
                's_sulfur'    => 20.0, 

                'boron'       => 0.50, 
                'zinc'        => 2.00, 
                'copper'      => 0.30, 
            ]
        ]);

        SoilStandard::create([
            'plant_type' => 'Sawit',
            'soil_type_id' => $gambut->id,
            'standard_values' => [
                'ph_level'    => 5.0,
                'c_organic'   => 20.0,
                'ktk'         => 25.0,

                'n_total'     => 0.30,
                'p_available' => 25.0,
                'k_exchange'  => 0.40, 
                'mg_exchange' => 0.40, 
                'ca_exchange' => 3.00, 
                's_sulfur'    => 30.0, 

                'boron'       => 1.00, 
                'zinc'        => 5.00,
                'copper'      => 3.00,
            ]
        ]);
        
        SoilStandard::create([
            'plant_type' => 'Sawit',
            'soil_type_id' => $darat->id,
            'standard_values' => [
                'ph_level'    => 5.0, 
                'c_organic'   => 1.5,
                'ktk'         => 10.0,
                'n_total'     => 0.12,
                'p_available' => 10.0,
                'k_exchange'  => 0.20,
                'mg_exchange' => 0.25,
                'ca_exchange' => 1.50,
                's_sulfur'    => 15.0,
                'boron'       => 0.30,
                'zinc'        => 1.50,
                'copper'      => 0.20,
            ]
        ]);
    }
}