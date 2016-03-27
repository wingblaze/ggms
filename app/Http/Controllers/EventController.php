<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Resource;
use App\Event;
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{

	/**
     * Show the profile for the given event.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('events', ['events' => Event::all()]);
    }

    public function store(Request $request)
    {

        $event = new Event;

        $data = $request->all();

        $facility = Resource::where('name', $data['facility'])->first();

        if ($facility)
            $facilityID = $event->resource_id = $facility->id;
        else
            $facilityID = -1;

        $rules = [
            'name' => 'required|unique:events,name',
            'description' => 'required',
            'expected_attendees' => 'required',
            'facility' => 'exists:resources,name',
            'start_date' => 'required|no_conflict:' . $facilityID,
            'end_date' => 'required',
            
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
            'start_date.no_conflict' => 'That facility is already in use during that time.'
        ];

        // $this->validate($request, $rules, $messages);


        

        $event->name = $data['name'];

        $event->description = $data['description'];
        $event->expected_attendees = $data['expected_attendees'];

        $event->start_date = Carbon::parse($data['start_date']);
        $event->end_date = Carbon::parse($data['end_date']);

        $notes = (object)[];

        $user = Auth::user();
        if ($user->hasRole('user')){
            $notes->requested_by = $user->id;
        }

        $notes->status = 'Unpaid';
        


        if (isset($data['contact_details']))
            $notes->preparations['contact_details'] = $data['contact_details'];

        if (isset($data['projector']))
            $notes->preparations['projector'] = $data['projector'];

        if (isset($data['chairs']))
            $notes->preparations['chairs'] = $data['chairs'];

        if (isset($data['tables']))
            $notes->preparations['tables'] = $data['tables'];

        if (isset($data['dining_setup']))
            $notes->preparations['dining_setup'] = $data['dining_setup'];

        if (isset($data['in_house_cleaning']))
            $notes->preparations['in_house_cleaning'] = $data['in_house_cleaning'];
        
        $event->notes = json_encode($notes);
        
        $event->save();
        return redirect()->action('EventController@show', [$event->id]);
    }

    public function show($id)
    {
    	return view('events.show', ['event' => Event::findOrFail($id)]);
    }

    public function create()
    {
    	return view('events.create');
    }

    public function edit($id)
    {
    	return view('events.edit', ['event' => Event::findOrFail($id)]);
    }

    public function destroy($id)
    {
    	
    }

    public function json(){
        $collection = Event::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }    

    public function __construct()
    {
        $this->middleware('role:employee|user');

        $this->middleware('role:membership_manager|golf_ops_manager|marketing_manager', ['only' => [
            'edit', 'destroy', 
            ]]);
    }
}
