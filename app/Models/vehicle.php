<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'chassis_number',
        'engine_number',
        'plate_number',
        'vehicle_type',
        'vehicle_brand',
        'vehicle_year',
        'vehicle_color',
    ];
}
