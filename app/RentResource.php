<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentResource extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the list of users who rented this resource
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the list of resources who rented this resource
     */
    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    protected $table = "rent_resources";
}
