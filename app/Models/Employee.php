<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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
        'country',
        'state',
        'address',
        'current_country',
        'current_state',
        'current_address',
        'email',
        'phone',
        'password',
        'facebook',
        'linkedin',
        'is_permanent',
        'main_language',
        'secondary_language',
        'first_skill',
        'first_skill_duration',
        'training_name',
        'training_duration',
        'training_certificate',
        'experience',
        'manager_id',
        'job_id',
    ];

    public function task()
    {
        return $this->belongsToMany(Task::class);
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
