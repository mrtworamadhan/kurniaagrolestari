<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'location',
        'area_size',
        'plant_type',
        'soil_type_id',
        'plant_age',
        'coordinates',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessments()
    {
        return $this->hasMany(LandAssessment::class);
    }

    public function soilType()
    {
        return $this->belongsTo(SoilType::class);
    }

    public function monitorings() 
    { 
        return $this->hasMany(GardenMonitoring::class); 
    }
    public function fertilizations()
    {
        return $this->hasMany(FertilizationRecord::class)->latest('fertilization_date');
    }

    public function harvests()
    {
        return $this->hasMany(HarvestRecord::class)->latest('harvest_date');
    }
    

}