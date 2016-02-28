<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Group;

class GroupController extends Controller
{
    /**
     * Show the profile for the given group.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('groups', ['groups' => Group::all()]);
    }

    public function show($id)
    {
    	return view('groups.show', ['group' => Group::findOrFail($id)]);
    }

    public function create()
    {
    	return view('groups.create');
    }

    public function store(Request $request)
    {
        $group = new Group;

        $data = $request->all();

        $group->name = $data['name'];

        $group->description = $data['description'];
        $group->type = $data['type'];

        $group->address = $data['address'];
        
        $group->phone = $data['phone'];
        $group->fax = $data['fax'];

        $group->save();
        return $this->show($group->id);
    }

    public function edit($id)
    {
    	return view('groups.edit', ['group' => Group::findOrFail($id)]);
    }

    public function destroy($id)
    {
    	return view('groups.destroy', ['group' => Group::findOrFail($id)]);
    }

    public function assign(){
        return view('groups.rent', ['groups' => Group::all()]);
    }

    public function json(){
        $collection = Group::all()->map(function ($group){
            return $group->name;
        });
        return json_encode($collection);
    }

    public function __construct()
    {
        $this->middleware('role:employee');

        $this->middleware('role:membership_manager', ['only' => [
            'store', 'edit', 'destroy', 'create'
            ]]);
    }
}
