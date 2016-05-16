<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MembershipControl;
use App\Account;

class MembershipSlot extends Model
{
    public function membership_control()
    {
    	$this->hasMany('App\MembershipControl');
    }

    public function account(){
        $account = MembershipControl::get_current_account_of($this->id);
        return $account;
    }
}
