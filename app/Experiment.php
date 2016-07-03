<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    public function equipment(){
        return $this->belongsToMany('App\Equipment')->withTimestamps();
    }
    public function parameters(){
        return $this->belongsToMany('App\Parameter')->withPivot('type_value_index')->withTimestamps();
    }

    public function dea(){
        return $this->belongsTo('App\Dea');
    }
}
