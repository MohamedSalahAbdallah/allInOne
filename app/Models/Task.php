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
        'assigned_by',
        'assigned_to',
        'file',
    ];

    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function groups()
    {
        return $this->belongsToMany(group::class);
    }
}
