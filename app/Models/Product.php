<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'image',
        'price_retail',
        'price_agent',
        'price_distributor',
        'stock',
        'unit',
        'short_description',
        'description',
        'specifications', 
        'usage_instruction',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array', 
        'is_active' => 'boolean',
        'price_retail' => 'decimal:2',
        'price_agent' => 'decimal:2',
        'price_distributor' => 'decimal:2',
    ];

    public function getPriceForUser($userGroup = 'retail')
    {
        return match ($userGroup) {
            'agent' => $this->price_agent,
            'distributor' => $this->price_distributor,
            default => $this->price_retail,
        };
    }
    public function benefits()
    {
        return $this->belongsToMany(Benefit::class, 'product_benefit');
    }

    public function soilTypes()
    {
        return $this->belongsToMany(SoilType::class, 'product_soil_type');
    }
}