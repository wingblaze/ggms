<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MembershipControl;
use App\MembershipSlot;

class Account extends Model
{
    public function users(){
    	return $this->hasMany('App\User');
    }

    public function owner(){
    	$users = $this->users;
    	foreach ($users as $user) {
    		if ($user->account_type == 'owner')
    			return $user;
    	}
    	return FALSE;
    }

    public function membership_control(){
        return $this->hasMany('App\MembershipControl');   
    }

    public function group(){
        return $this->belongsTo('App\Group');   
    }

    public function current_membership_slot()
    {
        return MembershipControl::latest_slot_of_account($this->id);
    }

    // Return newly created accounts, those that don't have any connections with user account relations yet.
    public function new_accounts(){
    	$used_accounts = DB::table('user_account_relations')->value('account_id');
    	return DB::table('accounts')->whereNotIn('id', $used_accounts)->get();
    }

    public function has_posted_listing(){
        $membership_control = MembershipControl::whereNull('membership_slot_id')->where('posted_by_account_id', $this->id)->first();
        return $membership_control;
    }
}
