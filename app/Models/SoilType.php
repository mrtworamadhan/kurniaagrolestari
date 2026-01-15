<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilType extends Model
{
    protected $fillable = ['name', 'description'];

    public function gardens() { return $this->hasMany(Garden::class); }
    public function standards() { return $this->hasMany(SoilStandard::class); }
}
