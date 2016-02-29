<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipSlot extends Model
{
    public function membership_control()
    {
    	$this->hasMany('App\MembershipControl');
    }

    public function owner(){
    	if ($this->membership_control_id){
    		$control = MembershipControl::find($this->membership_control_id);
    		$account = $control->current_account()->first();
    		return $account->owner();
    	}
    	return FALSE;
    }
}
