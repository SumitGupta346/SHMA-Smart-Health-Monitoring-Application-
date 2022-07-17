<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BMI extends Model
{
    protected $casts = [
        'height' => 'float',
        'weight' => 'float',
        'bmi' => 'float',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
