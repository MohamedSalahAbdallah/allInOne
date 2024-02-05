<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sector_id',
        'trade_license',
        'registry_office',
        'trade_license_number',
        'directorate',
        'director_name',
        'phone_number',
        'email',
        'sales_manager_name',
        'sales_manager_phone',
        'company_number',
        'fax_number',
        'headquarters_address',
        'company_email',
        'manufacturing_license'
    ];


    public function branches(){
        return $this->hasMany(branch::class);
    }
    public function sector()
    {
        return $this->belongsTo(sector::class);
    }
}
