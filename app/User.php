<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\UserAccountRelation;

class User extends Authenticatable
{
    use SoftDeletes;
    use EntrustUserTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function account(){
        return $this->belongsTo('App\Account');
    }

    public function complaints(){
        return $this->hasMany('App\Complaint');
    }

    /**
     * Get the resources this user has rented.
     */
    public function rent_listing()
    {
        return $this->hasMany('App\RentResource', 'rent_resources', 'id', 'id');
    }

    public function is_owner(){
        $account = $this->account;
        if ($account)
            return $account->owner()->id == $this->id;

        return FALSE;
    }

    public function getDisplayNameAttribute($value)
    {
        $split = explode("(", $this->name);

        if (count($split) > 1){
            $value = $split[0];
        }else{
            $value = $this->name;
        }
        return $value;
    }
}
