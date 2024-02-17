<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'name',
        'name_ar',
        'nid',
        'personal_image',
        'date_of_birth',
        'gender',
        'nationality',
        'marital_status',
        'religion',
        'criminal_case',
        'id_card_front',
        'id_card_back',
        'passport',
        'location',
        'health',
        'military_service',
        'country',
        'state',
        'address',
        'current_country',
        'current_state',
        'current_address',
        'email',
        'phone',
        'password',
        'social_media',
        'social_link',
        'is_permanent',
        'main_language',
        'secondary_language',
        //skils & training
        'experience',
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
