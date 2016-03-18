<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

use App\RentResource;
use Carbon\Carbon;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('no_conflict', function($attribute, $value, $parameters, $validator) {
            if ($value == -1)
                return FALSE;
            $res_id = $parameters[0];
            $start_time = Carbon::parse($value);
            $conflicts = RentResource::where('resource_id', $res_id)->where('start_time', '<=', $start_time)->where('end_time', '>', $start_time)->get();
            return count($conflicts) == 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
