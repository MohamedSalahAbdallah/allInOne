<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'nid',
        'position',
        'image',
        'permanent',
        'email',
        'phone',
        'password',
        'manager_id',
    ];

    public function task()
    {
        return $this->belongsToMany(Task::class);
    }

    public function group(){
        return $this->belongsToMany(group::class);
    }
}
