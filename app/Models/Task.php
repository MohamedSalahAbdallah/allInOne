<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'location',
        'file',
        'status',
        'starts_at',
        'ends_at',
        'starts_time',
        'end_time',
        'department_id',
        'sub_department_id',
        'site_id',
        'user_id',
        'employee_id',


    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function groups()
    {
        return $this->belongsToMany(group::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class ,"department_id");
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class,"subDepartment_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
