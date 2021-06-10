<?php

namespace App\Http\Controllers;

use App\Roles;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public $user;

    public function __construct(){
        $this->middleware(function ($request,$next){
$this->user=Auth::guard('admin')->user();
return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('admin.view')){
            abort(403,"The User Cant Access this Page");
        }
      $admins =Admin::all();
      return view('backend.auth.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403,"The User Cant Access this Page");
        }

        $roles =Role::all();
      return view('backend.auth.create',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403,"The User Cant Access this Page");
        }
        $validateData=$request->validate([

            'name' =>'required|max:100',
            'email' =>'required|max:100|email|unique:admins',
            'username' =>'required|max:100|unique:admins',
            'password' =>'required|min:6|confirmed'
        ],
        [
            'name.required' =>'Please Enter Your Name',
            'email.required' =>'Please Enter Your Email',
            'email.unique' =>'Email Already Exists',
        ]
    );

$user=new Admin;
$user->name=$request->name;
$user->email=$request->email;
$user->username=$request->username;
$user->password=Hash::make($request->password);
$user->save();
if($request->roles){
    $user->assignRole($request->roles);
}
    return back()->with('success','Admin Create Successfully !');


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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,"The User Cant Access this Page");
        }


        $admin =Admin::find($id);
        $roles =Role::all();

      return view('backend.auth.edit',compact('roles','admin'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,"The User Cant Access this Page");
        }
$user = Admin::find($id);
        $validateData=$request->validate([

            'name' =>'required|max:100',
            'email' =>'required|max:100|email|unique:admins,email,' .$id,
            'password' =>'nullable|min:6|confirmed'
        ],
        [
            'name.required' =>'Please Enter Your Name',
            'email.required' =>'Please Enter Your Email',
            'email.unique' =>'Email Already Exists',
        ]
    );

$user->name=$request->name;
$user->username=$request->username;
$user->email=$request->email;
if($request->password){

    $user->password=Hash::make($request->password);
}
$user->save();
$user->roles()->detach();
if($request->roles){
    $user->assignRole($request->roles);
}
    return back()->with('success','Admin Updated Successfully !');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403,"The User Cant Access this Page");
        }
        $user=Admin::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return back()->with('success','Admin delete');
    }
}
