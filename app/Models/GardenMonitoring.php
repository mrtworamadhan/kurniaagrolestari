<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GardenMonitoring extends Model
{
    protected $fillable = [
        'garden_id', 'monitoring_date', 'current_yield', 
        'frond_count', 'fruit_weight', 'visual_condition', 
        'recommendation_status', 'photos', 'assessor_id'
    ];

    protected $casts = [
        'photos' => 'array',
        'monitoring_date' => 'date',
    ];

    public function garden() 
    { 
        return $this->belongsTo(Garden::class); 
    }

    public function assessor() 
    { 
        return $this->belongsTo(User::class, 'assessor_id'); 
    }
}