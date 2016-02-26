<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Account;
use App\Complaint;
use Input;
use Carbon\Carbon;

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

        $account->group_id = $data['group'];

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
}
