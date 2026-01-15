<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    protected $fillable = [
        'name',
        'document_number',
        'file_path',
        'description',
    ];
}