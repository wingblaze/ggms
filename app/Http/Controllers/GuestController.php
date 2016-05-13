<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Routing\UrlGenerator;

use App\Account;
use App\Event;

use Carbon\Carbon;

class GuestController extends Controller
{
    public function index(){
    	$pending_accounts = Account::where('status', 'On Review')->limit(3)->get();
    	$events = Event::whereDate('start_date', '=', Carbon::today()->toDateString())->get();
    	return view('home', ['pending_accounts' => $pending_accounts, 'events' => $events]);
    }
}
