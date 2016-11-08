<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'title', 'terminal_id', 'user_id'
    ];

    public function account(){
        return $this->belongsTo('App\Account');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function terminal(){
        return $this->belongsTo('App\Terminal');
    }

    public function model(){
        return $this->belongsTo('App\Account');
    }
}
