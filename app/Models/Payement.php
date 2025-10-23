<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $guarded = [];

    public function parametre(){
        return $this->belongsTo(Parametre::class);
    }


    public function section(){
        return $this->belongsTo(Section::class);
    }
}
