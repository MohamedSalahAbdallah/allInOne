<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "user_name",
        "user_id",
        "user_phone",
        "country",
        "governorate",
        "city",
        "address",
    ];
    public function order()
    {
        return $this->belongsTo(order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
