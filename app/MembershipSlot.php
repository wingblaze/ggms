<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipSlot extends Model
{
    public function membership_control()
    {
    	$this->hasMany('App\MembershipControl');
    }
}
