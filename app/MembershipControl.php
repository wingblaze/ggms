<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipControl extends Model
{
    public function membership_slot()
    {
    	$this->belongsTo('App\MembershipSlot');
    }

    public function account()
    {
    	$this->belongsTo('App\Account');
    }
}
