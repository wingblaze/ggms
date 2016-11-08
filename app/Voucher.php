<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'member_id', 'member_account_id', 'remarks'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function member(){
        return $this->belongsTo('App\User');
    }

    public function member_account(){
        return $this->belongsTo('App\Account');
    }
}
