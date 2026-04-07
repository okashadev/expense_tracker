<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyLimit extends Model
{
    protected $fillable = [
        'user_id',
        'limit_amount',
    ];
}
