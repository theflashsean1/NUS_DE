<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function experiments(){
        return $this->belongsToMany('App\Experiment')->withTimestamps();
    }
}
