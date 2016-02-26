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
        return view('resources', ['resources' => Resource::all(), 'listings' => RentResource::all()]);
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

        $rent_resource->user_id = User::where('name', $data['client'])->first()->id;
        $rent_resource->resource_id = Resource::where('name', $data['resource'])->first()->id;
        $rent_resource->start_time = Carbon::parse($data['start']);
        $rent_resource->end_time = Carbon::parse($data['end']);
        $rent_resource->status = 'In use';
        $rent_resource->save();
        return $this->index();
    }

    public function rent(){
        return view('resources.rent', ['resources' => Resource::all()]);
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

}
