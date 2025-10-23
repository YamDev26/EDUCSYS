<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function studentParent(){
        return $this->belongsTo(StudentParent::class);
    }

    public function nationalitie(){
        return $this->belongsTo(Nationality::class);
    }
}
