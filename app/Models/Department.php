<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;


    protected $fillable =[
        'name',
        'description',
        'department_code'
    ];

    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
