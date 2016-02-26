<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipControl extends Model
{
    public function membership_slot()
    {
    	return $this->belongsTo('App\MembershipSlot');
    }

    public function account()
    {
    	return $this->belongsTo('App\Account');
    }
}
