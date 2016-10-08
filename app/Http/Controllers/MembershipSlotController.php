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

    public function auction()
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
            'type' => 'required'
            ];

        $messages = [
            'type.required' => 'The membership slot type is required.',
        ];

        $this->validate($request, $rules, $messages);

        // This is not yet implemented

        $slot = new MembershipSlot;

        $data = $request->all();

        $slot->type = $data['type'];

        $slot->description = $data['description'];

        $slot->save();

        return $this->show($slot->id);
    }

    public function edit($id)
    {
        $slot = MembershipSlot::findOrFail($id);
        $control = MembershipControl::get_current_account_of($id);
    	return view('slots.edit', ['slot' => $slot, 'control' => $control]);
    }

    public function update_slot(Request $request)
    {
        $rules = [
            'type' => 'required',
            'description' => 'required',
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        // This is not yet implemented

        $data = $request->all();

        $slot = MembershipSlot::findOrFail($data['slot_id']);

        $slot->type = $data['type'];

        $slot->description = $data['description'];

        $slot->save();

        // update account assignment

        return redirect()->action("MembershipSlotController@show", [$slot->id]);
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
