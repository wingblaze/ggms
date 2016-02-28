<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Account;
use App\Complaint;
use App\User;
use App\Group;
use Input;
use Carbon\Carbon;

use App\MembershipControl;
use App\MembershipSlot;
use Auth;
use DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the account.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts', ['accounts' => Account::all()]);
    }

    /**
     * Show the form for creating a new account.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = new Account;

        $data = $request->all();

        $group_id = Group::where('name', $data['group'])->first()->id;

        $account->group_id = $group_id;

        $account->expiration = Carbon::createFromFormat('Y-m-d', $data['expiration']);
        
        $account->home_address = $data['home_address'];
        $account->business_address = $data['business_address'];
        
        $account->phone = $data['phone'];
        $account->fax = $data['fax'];
        $account->email = $data['email'];


        $account->tin_number = $data['tin_number'];
        $account->bank_account = $data['bank_account'];
        $account->credit_card_number = $data['credit_card_number'];

        $account->residence_certificate_id = $data['residence_certificate_id'];
        $account->residence_certificate_place_issued = $data['residence_certificate_place_issued'];
        $account->residence_certificate_date_issued = Carbon::createFromFormat('Y-m-d', $data['residence_certificate_date_issued']);

        $account->save();
        return $this->index();
    }

    /**
     * Display the specified account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('accounts.show', ['account' => Account::findOrFail($id), 'complaints' => Complaint::where('account_id', '=', $id)->get()]);
    }

    /**
     * Show the form for editing the specified account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified account from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function create_listing(){
        $user = Auth::user();
        $has_posted_listing = $user->account->has_posted_listing();
        return view('accounts.post_listing', ['canPostListing' => !$has_posted_listing]);
    }

    public function post_listing(){
        $user = Auth::user();
        $has_posted_listing = $user->account->has_posted_listing();
        if ($has_posted_listing){
            // error
        }else{
            DB::table('membership_controls')->insert(['account_id' => $user->account->id, 'membership_slot_id' => NULL]);
        }
        return $this->listings();
    }

    public function remove_listing(){
        $user = Auth::user();
        $has_posted_listing = $user->account->has_posted_listing();
        if ($has_posted_listing)
        {
            $has_posted_listing->delete();
        }
        return $this->listings();
    }

    public function listings(){
        $user = Auth::user();
        $has_posted_listing = $user->account->has_posted_listing();

        $listings = MembershipControl::whereNull('membership_slot_id')->get();
        foreach ($listings as $listing) {
            $slot_id = MembershipControl::where('account_id', $listing->account_id)->whereNotNull('membership_slot_id')->first()->membership_slot_id;
            $listing->slot = MembershipSlot::find($slot_id);
        }

        return view('accounts.listings', ['listings' => $listings, 'canPostListing' => !$has_posted_listing]);
    }


    public function json() {
        $collection = Account::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }

    public function assign($id) {
        return view('accounts.assign', ['account_id' => $id]);
    }

    /**
     *  Assigns a user to an account
     *
     */
    public function assign_user(Request $request) {      
        $data = $request->all();        
        $user = User::where('name', $data['user'])->first();
        $user->account_id = $data['id'];
        if (array_key_exists('owner', $data)) {
            $user->account_type = 'owner';
        } else {
            $user->account_type = 'dependent';
        }
        $user->save();

        return view('accounts.show', ['account' => Account::findOrFail($data['id']), 'complaints' => Complaint::where('account_id', '=', $data['id'])->get()]);
    }

    public function __construct()
    {
        $this->middleware('role:user', ['only' => [
            'remove_listing', 'post_listing', 'create_listing'
            ]]);

        $this->middleware('role:membership_manager', ['only' => [
            'store', 'edit', 'destroy', 'create'
            ]]);
    }
}
