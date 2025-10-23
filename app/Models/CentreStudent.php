<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentreStudent extends Model
{
    protected $guarded = [];


    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }


    public function originSchool(){
        return $this->belongsTo(OriginSchool::class);
    }

}
