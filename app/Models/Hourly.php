<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hourly extends Model
{
    protected $guarded = [];


    public function appels(){
        return $this->hasMany(Appel::class, 'hourlie_id', 'id');
    }

    public function hasAppel($student, $hourly)
    {
        return $this->appels()
        ->where('centre_student_id', $student)
        ->where('hourlie_id', $hourly)
        ->exists();
    }
}
