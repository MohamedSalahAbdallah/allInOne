<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'location',
        'description',
        'supplier_id',
    ];

    //Define want too many relationship with branches.
    public function supplier(){

        return $this->belongsTo(supplier::class);
    }
}
