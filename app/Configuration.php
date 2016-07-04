<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    public function Deas(){
        return $this->hasMany('App\Dea');
    }
    
}
