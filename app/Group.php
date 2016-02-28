<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function accounts(){
        return $this->hasMany('App\Account');   
    }
}
