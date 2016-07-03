<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    public function experiments(){
        return $this->belongsToMany('App\Experiment')->withPivot('type_value_index')->withTimestamps();
    }
}
