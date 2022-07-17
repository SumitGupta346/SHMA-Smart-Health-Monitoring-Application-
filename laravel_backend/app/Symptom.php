<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    //
    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }
}
