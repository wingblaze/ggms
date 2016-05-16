<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MembershipSlot;
use App\MembershipControl;
use Carbon\Carbon;

class MembershipSlotController extends Controller
{

	/**
     * Show the profile for the given slot.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('slots', ['slots' => MembershipSlot::all()]);
    }

    public function show($id)
    {
        $slot = MembershipSlot::findOrFail($id);


        $listings = MembershipControl::where('membership_slot_id', $id)->orderBy('created_at', 'asc')->get();

        foreach ($listings as $listing) {
            $listing->slot = $id;
        }

    	return view('slots.show', ['slot' => $slot, 'listings' => $listings]);
    }

    public function create()
    {
    	return view('slots.create');
    }

    /**
     * Store a newly created slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:events,name',
            'description' => 'required',
            'type' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'fax' => 'required'
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        // This is not yet implemented

        $slot = new MembershipSlot;

        $data = $request->all();

        $slot->name = $data['name'];

        $slot->email = $data['email'];
        $slot->mobile_number = $data['mobile_number'];

        $slot->password = bcrypt($data['password']);

        $slot->birth_date = Carbon::createFromFormat('Y-m-d', $data['birth_date']);
        $slot->birth_place = $data['birth_place'];
        
        $slot->nationality = $data['nationality'];
        $slot->gender = $data['gender'];

        $slot->salutation = $data['salutation'];

        $slot->civil_status = $data['civil_status'];
        
        $slot_type = ($data['slot_type'] == 'employee') ? 'employee' : 'slot';

        $role = Role::where('name', $slot_type)->first();
        
        $slot->save();

        $slot->attachRole($role);

        $slot->save();

        return $this->show($slot->id);
    }

    public function edit($id)
    {
        $slot = MembershipSlot::findOrFail($id);
    	return view('slots.edit', ['slot' => $slot]);
    }

    public function assign() 
    {
      return view('slots.assign');
    }

    public function destroy($id)
    {
    	
    }

    public function json(){
        $collection = MembershipSlot::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }    


	public function __construct()
	{
		$this->middleware('role:employee');
		
		$this->middleware('role:system_administrator', ['only' => [
			'store', 'edit', 'destroy', 'create'
			]]);
	}
}
