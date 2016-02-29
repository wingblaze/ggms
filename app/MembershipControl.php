<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipControl extends Model
{
    public function membership_slot()
    {
    	return $this->belongsTo('App\MembershipSlot');
    }

    public function posted_by_account()
    {
    	return $this->belongsTo('App\Account', 'posted_by_account_id');
    }

    public function current_account()
    {
    	return $this->belongsTo('App\Account', 'current_account_id');
    }
}
