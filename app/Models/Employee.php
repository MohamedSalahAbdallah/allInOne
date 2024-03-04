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
        'gender',
        'health',
        'integratedServices',
        'landLine',
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
        'password',
        'manager_id',
        'job_id',
        'level',
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
}
