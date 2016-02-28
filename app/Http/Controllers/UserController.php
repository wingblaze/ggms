<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
	/**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('users', ['users' => User::all()]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
    	return view('users.show', ['user' => $user]);
    }

    public function create()
    {
    	return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $data = $request->all();

        $user->name = $data['name'];

        $user->email = $data['email'];
        $user->mobile_number = $data['mobile_number'];

        $user->password = bcrypt($data['password']);

        $user->birth_date = Carbon::createFromFormat('Y-m-d', $data['birth_date']);
        $user->birth_place = $data['birth_place'];
        
        $user->nationality = $data['nationality'];
        $user->gender = $data['gender'];

        $user->salutation = $data['salutation'];

        $user->civil_status = $data['civil_status'];

        $user->save();
        return $this->show($user->id);
    }

    public function edit($id)
    {
    	return view('users.edit', ['user' => User::findOrFail($id)]);
    }

    public function assign() 
    {
      return view('users.assign');
    }

    public function destroy($id)
    {
    	
    }

    public function json(){
        $collection = User::all()->map(function ($resource){
            return $resource->name;
        });
        return json_encode($collection);
    }    

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('role:employee|user', ['except' => [
            'index'
            ]]);

        $this->middleware('role:membership_manager', ['only' => [
            'store', 'edit', 'destroy', 'create', 'assign_account'
            ]]);
    }
}
