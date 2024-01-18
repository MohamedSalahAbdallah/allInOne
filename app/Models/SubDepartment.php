<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubDepartment extends Model
{
    use HasFactory;


    protected $fillable=[
        "name",
        "description",
        "department_id"
    ];

    public function department()
    {
        return $this->belongsTo(Department::class ,"department_id");
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
