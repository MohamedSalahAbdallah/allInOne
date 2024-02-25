<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;



class Employee extends SanctumPersonalAccessToken
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'address',
        'asylumCard',
        'certificate',
        'country',
        'current_address',
        'current_country',
        'current_state',
        'date_of_birth',
        'email',
        'entryVisa',
        'facebook',
        'gender',
        'health',
        'instagram',
        'integratedServices',
        'landLine',
        'linkedIn',
        'main_language',
        'marital_status',
        'militaryCertificate',
        'militaryStatus',
        'name',
        'name_ar',
        'passport',
        'phone',
        'religion',
        'secondary_language',
        'state',
        'id_nationalCard_back',
        'id_nationalCard_front',
        'nationalId',
        'nationality',
        'manager_id',
        'job_id',
        'level',
        'is_online',
    ];

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function group(){
        return $this->belongsToMany(group::class);
    }

    public function manager(){
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function employee_skill() {
        return $this->hasMany(EmployeeSkill::class);
    }

    public function employee_training() {
        return $this->hasMany(EmployeeTraining::class);
    }
}
