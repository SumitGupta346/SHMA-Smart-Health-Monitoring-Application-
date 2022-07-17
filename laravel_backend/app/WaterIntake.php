<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class WaterIntake extends Model
{
    protected $casts = [
        'intake_litres' => 'float',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
