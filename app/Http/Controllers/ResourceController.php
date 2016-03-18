<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Resource;
use App\RentResource;
use Carbon\Carbon;

use App\User;

class ResourceController extends Controller
{
    
	/**
     * Show the profile for the given resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('resources', ['resources' => Resource::all(), 'listings' => RentResource::whereDate('start_time', '=', Carbon::today()->toDateString())->orderBy('start_time', 'asc')->get() ]);
    }

    public function show($id)
    {
    	return view('resources.show', ['resource' => Resource::findOrFail($id)]);
    }

    public function create()
    {
    	return view('resources.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'unique:groups,name',
            'description' => 'required',
            'type' => 'required'
            ];

        $messages = [
            'description.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        $resource = new Resource;

        $data = $request->all();

        $resource->name = $data['name'];
        $resource->description = $data['description'];
        $resource->type = $data['type'];

        $resource->save();
        return $this->show($resource->id);
    }

    public function edit($id)
    {
    	return view('resources.edit', ['resource' => Resource::findOrFail($id)]);
    }

    public function destroy($id)
    {
    	return view('resources.destroy', ['resource' => Resource::findOrFail($id)]);
    }

    public function store_rent(Request $request)
    {
        $rent_resource = new RentResource;
        $data = $request->all();



        $resource = Resource::where('name', $data['resource'])->first();
        $facilityID = ($resource) ? $resource->id : -1;

        $rules = [
            'client' => 'required|exists:users,name',
            'resource' => 'required|exists:resources,name',
            'start' => 'required|no_conflict:' . $facilityID,
            'end' => 'required',
            
            ];

        $messages = [
            'start.no_conflict' => 'That flight is already in use during that time.',
            'resource.required' => 'The flight field is required.',
            'resource.exists' => 'The select flight is invalid.  Please select from the autocomplete suggestions.'
        ];

        $this->validate($request, $rules, $messages);

        $rent_resource->user_id = User::where('name', $data['client'])->first()->id;
        $rent_resource->resource_id = $resource->id;
        $rent_resource->start_time = Carbon::parse($data['start']);
        $rent_resource->end_time = Carbon::parse($data['end']);
        $rent_resource->status = 'In use';
        $rent_resource->save();
        return $this->index();
    }

    public function rent(){
        return view('resources.rent', ['resources' => Resource::where('type', '!=', 'golf')->get()]);
    }

    public function golf(){
        return view('resources.golf', ['resources' => Resource::where('type', 'golf')->get()]);
    }

    public function maintenance(){
        return view('resources.maintenance', ['resources' => Resource::where('type', 'golf')->get()]);
    }

    public function listing(){
        return view('resources.listing', ['resources' => Resource::all(), 'listings' => RentResource::all()]);
    }

    public function json(){
        $collection = Resource::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }

    public function golf_json(){
        $collection = Resource::where('type', 'golf')->get()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }

    public function type_json(){
        $collection = Resource::select('type')->groupBy('type')->get()->map(function ($item, $key){
            return $item->type;
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
