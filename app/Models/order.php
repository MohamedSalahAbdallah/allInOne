<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = ['category',
    'type',
    'style',
    'count',
    'gender',
    'priority',
    'price',
    'iron',
    'rafa',
    'wash',
    'tincture',
    'task_id'
    ];

    public function task() {
        return $this->belongsTo(Task::class,'task_id');
    }
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
