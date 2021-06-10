<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
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



        if( is_null($this->user) || !$this->user->can('role.view') ){
            abort(403,"The User Can Not Access this Page");
        }


      $roles =Role::all();
      return view('backend.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( is_null($this->user) || !$this->user->can('role.create') ){
            abort(403,"The User Can Not Access this Page");
        }

        $permissions =Permission::all();
        $permissions_group =User::getPermissionsGroups();

      return view('backend.roles.create',compact('permissions','permissions_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( is_null($this->user) || !$this->user->can('role.create') ){
            abort(403,"The User Can Not Access this Page");
        }

        $validateData=$request->validate([

            'name' =>'required|max:100|unique:roles'
        ],
        [
            'name.required' =>'Please Give a Role Name'
        ]
    );

        $roleName=$request->name;
        $permissions=$request->input('permissions');
      $check =Role::where('name',$roleName)->first();
      if($check){
return back()->with('exiest','The name already Exists Try Another Name');
      }else{
        $roleCreate= Role::create([
            'name' => $roleName,
            'guard_name'=>'admin',
            ]);
            if(!empty($permissions)){
                $roleCreate->syncPermissions($permissions);
            }
            return back()->with('success','Role Create Successfully !');


      }



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
        if( is_null($this->user) || !$this->user->can('role.edit') ){
            abort(403,"The User Can Not Access this Page");
        }
        $role =Role::findById($id,'admin');
        $all_permissions =Permission::all();
        $permissions_group =User::getPermissionsGroups();

      return view('backend.roles.edit',compact('role','all_permissions','permissions_group'));
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
        if( is_null($this->user) || !$this->user->can('role.edit') ){
            abort(403,"The User Can Not Access this Page");
        }

        $validateData=$request->validate([

            'name' =>'required|max:100'
        ],
        [
            'name.required' =>'Please Give a Role Name'
        ]
    );

    $role= Role::findById($id,'admin');
        $permissions=$request->input('permissions');

            if(!empty($permissions)){
                $role->name=$request->name;
                $role->save();
                $role->syncPermissions($permissions);
            }
            return back()->with('success','Role Updated Successfully !');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( is_null($this->user) || !$this->user->can('role.delete') ){
            abort(403,"The User Can Not Access this Page");
        }
        $role=Role::findById($id,'admin');
        if(!is_null($role)){
            $role->delete();
        }
        return back()->with('success','Role delete');
    }
}
