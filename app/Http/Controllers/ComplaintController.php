<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Zizaco\Entrust\Middleware\EntrustRole;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Complaint;
use App\Account;
use Auth;

class ComplaintController extends Controller
{
    /**
     * Show the profile for the given complaint.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('complaints', ['complaints' => Complaint::all(), 'accounts' => Account::where('status', '=', 'On Review')->get()]);
    }

    public function show($id)
    {
    	return view('accounts.show', ['account' => Account::findOrFail($id), 'complaints' => Complaint::where('account_id', '=', $id)->get()]);
    }

    public function create($id)
    {
        $user = Auth::user();
        if (!$user){
            return redirect('/');
        }
    	return view('complaints.create', ['account' => Account::findOrFail($id), 'user' => $user]);
    }

    public function store(Request $request)
    {
         $rules = [
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
            'account_id' => 'required|exists:accounts,id'
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        $complaint = new Complaint;

        $data = $request->all();

        $complaint->user_id = $data['user_id'];
        $complaint->content = $data['content'];

        $complaint->account_id = $data['account_id'];

        $complaint->save();
        return $this->show($complaint->account_id);
    }

    public function edit($id)
    {
    	return view('complaints.edit', ['complaint' => Complaint::findOrFail($id)]);
    }

    public function destroy($id)
    {
    	return view('complaints.destroy', ['complaint' => Complaint::findOrFail($id)]);
    }

    public function assign(){
        return view('complaints.rent', ['complaints' => Complaint::all()]);
    }

    public function json(){
        $collection = Complaint::all()->map(function ($complaint){
            return $complaint->name;
        });
        return json_encode($collection);
    }

    public function __construct(){
        $this->middleware('role:user|employee');
    }
    
}
