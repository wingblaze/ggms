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
use Validator;

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
        $controls = MembershipControl::select('membership_slot_id')->distinct()->get();
        $available_slots = MembershipSlot::whereNotIn('id', $controls)->orderBy('id')->get();
        return view('accounts.create', ['slots' => $available_slots]);
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $rules = [
            'group' => 'exists:groups,name',
            'expiration' => 'required',
            'home_address' => 'required',
            'business_address' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'tin_number' => 'required|unique:accounts',
            'bank_account' => 'required',
            'credit_card_number' => 'required',
            'residence_certificate_id' => 'required',
            'residence_certificate_place_issued' => 'required',
            'residence_certificate_date_issued' => 'required',
            ];

        if ($data['membership_slot'] != -1)
            $rules['membership_slot'] = 'exists:membership_slots,id';

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        $account = new Account;


        if (isset($data['group']) && $data['group']){
            $group_id = Group::where('name', $data['group'])->first()->id;

            $account->group_id = $group_id;
        }

        if ($data['expiration'])
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
        if ($data['residence_certificate_date_issued'])
            $account->residence_certificate_date_issued = Carbon::createFromFormat('Y-m-d', $data['residence_certificate_date_issued']);

        // assign account slot
        $membership_slot_id = $data['membership_slot'];

        $account->save();

        if ($data['membership_slot'] != -1){
            $control = new MembershipControl;
            $control->posted_by_account_id = 1; // system administrator
            $control->current_account_id = $account->id;
            $control->membership_slot_id = $membership_slot_id;
            $control->save();
        }
        
        return $this->index();
    }

    public function assign_slot(Request $request){
        $data = $request->all();

        if ($data['membership_slot'] != -1)
            $rules['membership_slot'] = 'exists:membership_slots,id';

        $messages = [
            'membership_slot.exists' => 'The membership slot you wish to assign does not exist.',
        ];

        $this->validate($request, $rules, $messages);

        $account_id = $data['account_id'];
        $membership_slot_id = $data['membership_slot'];

        if ($data['membership_slot'] != -1 && $account_id){
            $control = new MembershipControl;
            $control->posted_by_account_id = 1; // system administrator
            $control->current_account_id = $account_id;
            $control->membership_slot_id = $membership_slot_id;
            $control->save();
        }

        return redirect()->action('AccountController@index');
    }

    /**
     * Display the specified account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('accounts.show', ['account' => Account::findOrFail($id), 'slots' => MembershipSlot::whereNotIn('id', MembershipControl::select('membership_slot_id')->distinct()->get())->orderBy('id')->get(), 'complaints' => Complaint::where('account_id', '=', $id)->get()]);
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

        if ($user->account == FALSE) 
            return redirect()->action('AccountController@listings')
                             ->with('errors', collect(['The user currently does not have an account.']));
        
        $slot = MembershipControl::latest_slot_of_account($user->account->id);

        if ($slot == FALSE)
            return redirect()->action('AccountController@listings')
                             ->with('errors', collect(['The user\'s account currently does not have a membership slot yet.']));

        if ($has_posted_listing)
            return redirect()->action('AccountController@listings')
                             ->with('errors', collect(['The user has already posted a club share listing.']));

        DB::table('membership_controls')->insert(['posted_by_account_id' => $user->account->id, 'membership_slot_id' => NULL, 'created_at' => Carbon::now()]);
        
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

        if ($user->account)
            $has_posted_listing = $user->account->has_posted_listing();
        else
            $has_posted_listing = FALSE;

        $listings = MembershipControl::whereNull('membership_slot_id')->get();

        foreach ($listings as $listing) {
            $slot = MembershipControl::where('posted_by_account_id', $listing->posted_by_account_id)->whereNotNull('membership_slot_id')->first();
            if ($slot){
                $slot_id = $slot->membership_slot_id;
                $listing->slot = MembershipSlot::find($slot_id);
            }
        }

        return view('accounts.listings', ['listings' => $listings, 'canPostListing' => !$has_posted_listing]);
    }

    public function report_listings(Request $request)
    {

        $data = $request->all();
        
        $listings = MembershipControl::orderBy('updated_at', 'asc')->get();

        if (isset($data['start']) && isset($data['end'])){
            $start = Carbon::parse($data['start']);
            $end = Carbon::parse($data['end']);

            $listings = $listings->where(function ($query)
            {
                $query->where('created_at', '>=', $start);
                $query->where('created_at', '<', $end);
            })->orWhere(function ($query)
            {
                $query->where('updated_at', '>=', $start);
                $query->where('updated_at', '<', $end);
            })->get();
        }

        return view('accounts.report_listings', ['listings' => $listings]);
    }


    public function json() {
        $collection = Account::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }

    public function assign($id) {
        return view('accounts.assign', ['account_id' => $id, 'account' => Account::findOrFail($id)]);
    }

    // accept after complaints
    public function accept($id)
    {
        $account = Account::find($id);
        if ($account->owner()) {
            $account->status = 'Inactive';
            $account->remarks = 'This account has not yet paid its fees.';
            $account->save();
            return redirect()->action('AccountController@show', $id);
        }else{
            return redirect()->action('ComplaintController@show', $id);
        }
    }

    // clear_account
    public function clear_account($id)
    {
        $account = Account::find($id);
        if ($account->owner()) {
            $account->status = 'Active';
            $account->remarks = NULL;
            $account->save();
            return redirect()->action('AccountController@show', $id);
        }else{
            return redirect()->action('ComplaintController@show', $id);
        }
    }


    public function clear_payment($id)
    {
        $account = Account::find($id);
        if ($account->owner()) {
            $account->status = 'Paid';
            $account->remarks = NULL;
            $account->save();
            return redirect()->action('AccountController@show', $id);
        }else{
            return redirect()->action('ComplaintController@show', $id);
        }
    }

    /**
     *  Assigns a user to an account
     *
     */
    public function assign_user(Request $request) {      
        $data = $request->all();        
        $user = User::where('name', $data['user'])->first();

        if (!$user)
            return redirect()->action('AccountController@index');

        $user->account_id = $account_id = $data['id'];

        

        if (array_key_exists('owner', $data)) {
            // Remove previous owner if he/she already exists
            $account = Account::find($account_id);

            $owner = $account->owner();
            if ($owner){
                $owner->account_type = 'dependent';
                $owner->save();
            }

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
