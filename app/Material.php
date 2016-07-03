<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function Deas(){
        return $this->hasMany('App\Dea');
    }
}
