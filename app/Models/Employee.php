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
        'first_skill',
        'first_skill_duration',
        'second_skill',
        'second_skill_duration',
        'third_skill',
        'third_skill_duration',
        'forth_skill',
        'forth_skill_duration',
        'fifth_skill',
        'fifth_skill_duration',
        'first_training_name',
        'first_training_duration',
        'first_training_certificate',
        'second_training_name',
        'second_training_duration',
        'second_training_certificate',
        'third_training_name',
        'third_training_duration',
        'third_training_certificate',
        'fourth_traning_name',
        'fourth_traning_duration',
        'fourth_traning_certificate',
        'fifth_traning_name',
        'fifth_traning_duration',
        'fifth_traning_certificate',
        'experience',
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
