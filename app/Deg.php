<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deg extends Model
{
    public function dimension(){
        return $this->belongsTo('App\Dimension');
    }

    public function configuration(){
        return $this->belongsTo('App\Configuration');
    }

    public function material(){
        return $this->belongsTo('App\Material');
    }

    public function experiments(){
        return $this->hasMany('App\Experiment');
    }

}
