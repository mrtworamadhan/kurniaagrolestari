<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandAnalysisRequest extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'photos' => 'array',
    ];

    public function soilType()
    {
        return $this->belongsTo(SoilType::class);
    }
}