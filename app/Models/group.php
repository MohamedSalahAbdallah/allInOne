<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function employee(){
        return $this->belongsToMany(Employee::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
