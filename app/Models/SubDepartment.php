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
        "department_id",
        "sup_department_code"
    ];

    public function department()
    {
        return $this->belongsTo(Department::class ,"department_id");
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
