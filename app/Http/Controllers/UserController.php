<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
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
    	return view('users.show', ['target_user' => $user]);
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
        $rules = [
            'name' => 'required|',
            'email' => 'required|unique:users,email',
            'mobile_number' => 'required',
            'password' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'salutation' => 'required',
            'civil_status' => 'required',
            'user_type' => 'required',
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

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
        
        $user_type = ($data['user_type'] == 'employee') ? 'employee' : 'user';

        $role = Role::where('name', $user_type)->first();
        
        $user->save();

        $user->attachRole($role);

        $user->save();

        $user->name = $user->name . " (" . $user->id . ")";
        
        $user->save();

        return $this->show($user->id);
    }

    public function update_user(Request $request)
    {
        $rules = [
            'name' => 'required|',
            'mobile_number' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'salutation' => 'required',
            'civil_status' => 'required',
            ];

        $messages = [
            'expiration.required' => 'The member\'s account expiration date is required.',
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();

        $user = User::find($data['user_id']);

        $user->name = $data['name'];

        $user->email = $data['email'];
        $user->mobile_number = $data['mobile_number'];

        $user->birth_date = Carbon::createFromFormat('Y-m-d', $data['birth_date']);
        $user->birth_place = $data['birth_place'];
        
        $user->nationality = $data['nationality'];
        $user->gender = $data['gender'];

        $user->salutation = $data['salutation'];

        $user->civil_status = $data['civil_status'];
        

        $user->name = $user->name . " (" . $user->id . ")";
        
        $user->save();

        return redirect()->action('UserController@show', $user->id);
    }

    public function edit($id)
    {
    	return view('users.edit', ['target_user' => User::findOrFail($id)]);
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
            'update_user', 'store', 'edit', 'destroy', 'create', 'assign_account'
            ]]);
    }
}
