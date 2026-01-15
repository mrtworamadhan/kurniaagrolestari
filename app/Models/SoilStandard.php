<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilStandard extends Model
{
    protected $fillable = ['plant_type', 'soil_type_id', 'standard_values'];

    protected $casts = [
        'standard_values' => 'array',
    ];

    public function soilType()
    {
        return $this->belongsTo(SoilType::class);
    }
}