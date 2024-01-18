<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable=[
        "name",
        "description",
        "sub_department_id"
    ];

    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class,"subDepartment_id");
    }

    public function Employees(){
        return $this->hasMany(Employee::class);
    }
}
