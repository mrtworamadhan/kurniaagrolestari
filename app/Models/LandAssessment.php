<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandAssessment extends Model
{
    protected $fillable = [
        'garden_id',
        'status', 
        'plant_variety',
        'topography',
        'current_condition',
        'fertilizer_history',
        'bunch_weight',
        'current_yield',
        'target_yield',
        'photos', 
        'video_url',
    ];

    protected $casts = [
        'photos' => 'array', 
    ];

    public function garden()
    {
        return $this->belongsTo(Garden::class);
    }

    public function labResult()
    {
        return $this->hasOne(LabResult::class);
    }

    public function recommendation()
    {
        return $this->hasOne(Recommendation::class);
    }
}