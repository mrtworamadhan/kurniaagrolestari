<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'land_assessment_id',
        'summary',
        'product_recommendations', 
        'application_notes',
    ];

    protected $casts = [
        'product_recommendations' => 'array', 
    ];

    public function assessment()
    {
        return $this->belongsTo(LandAssessment::class, 'land_assessment_id');
    }
}