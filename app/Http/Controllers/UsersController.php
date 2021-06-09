<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users =User::all();
      return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =Role::all();

      return view('backend.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData=$request->validate([

            'name' =>'required|max:100',
            'email' =>'required|max:100|email|unique:users',
            'password' =>'required|min:6|confirmed'
        ],
        [
            'name.required' =>'Please Enter Your Name',
            'email.required' =>'Please Enter Your Email',
            'email.unique' =>'Email Already Exists',
        ]
    );

$user=new User;
$user->name=$request->name;
$user->email=$request->email;
$user->password=Hash::make($request->password);
$user->save();
if($request->roles){
    $user->assignRole($request->roles);
}
    return back()->with('success','User Create Successfully !');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::find($id);
        $roles =Role::all();

      return view('backend.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
$user = User::find($id);
        $validateData=$request->validate([

            'name' =>'required|max:100',
            'email' =>'required|max:100|email|unique:users,email,' .$id,
            'password' =>'nullable|min:6|confirmed'
        ],
        [
            'name.required' =>'Please Enter Your Name',
            'email.required' =>'Please Enter Your Email',
            'email.unique' =>'Email Already Exists',
        ]
    );

$user->name=$request->name;
$user->email=$request->email;
if($request->password){

    $user->password=Hash::make($request->password);
}
$user->save();
$user->roles()->detach();
if($request->roles){
    $user->assignRole($request->roles);
}
    return back()->with('success','User Updated Successfully !');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return back()->with('success','User delete');
    }
}
