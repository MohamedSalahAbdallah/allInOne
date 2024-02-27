<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable=[
        "job_code",
        "name",
        "description",
        "sub_department_id",
        "department_id",
        "status",


    ];

    public function department()
    {
        return $this->belongsTo(Department::class ,"department_id");
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class,"subDepartment_id");
    }

    public function Employees(){
        return $this->hasMany(Employee::class);
    }

}
