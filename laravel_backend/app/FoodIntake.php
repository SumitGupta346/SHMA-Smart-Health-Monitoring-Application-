<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class FoodIntake extends Model
{
    protected $casts = [
        'food' => 'string',
        'cal' => 'float',
        'fat' => 'float',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
