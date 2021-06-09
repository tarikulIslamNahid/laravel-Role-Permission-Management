<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $role =Role::findById($id);
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

        $validateData=$request->validate([

            'name' =>'required|max:100'
        ],
        [
            'name.required' =>'Please Give a Role Name'
        ]
    );

    $role= Role::findById($id);
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
        $role=Role::findById($id);
        if(!is_null($role)){
            $role->delete();
        }
        return back()->with('success','Role delete');
    }
}
