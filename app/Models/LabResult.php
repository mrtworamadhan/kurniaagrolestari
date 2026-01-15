<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    protected $fillable = [
        'land_assessment_id',
        'package_type',
        'ph_level',
        'c_organic',
        'ktk',
        'n_total',
        'p_available',
        'k_exchange',
        'mg_exchange',
        'ca_exchange',
        's_sulfur',
        'boron',
        'zinc',
        'copper',
        'lab_notes',
        'checked_at',
    ];

    protected $casts = [
        'checked_at' => 'date',
    ];

    public function assessment()
    {
        return $this->belongsTo(LandAssessment::class, 'land_assessment_id');
    }
}