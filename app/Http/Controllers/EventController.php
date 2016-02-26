<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Instantiate a new EventController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
	}

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

        $event->name = $data['name'];

        $event->description = $data['description'];
        $event->expected_attendees = $data['expected_attendees'];

        $event->start_date = Carbon::parse($data['start_date']);
        $event->end_date = Carbon::parse($data['end_date']);

        if (array_key_exists('resource_id', $data))
            $event->resource_id = $data['resource_id'];

        $event->save();
        return $this->show($event->id);
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
}
