<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        return view('backend.pages.roles.index',['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $roleStore = new Role();
        $roleStore->name = $request->name;
        $roleStore->slug = $request->slug;
        $roleStore->save();
        $listOfPermissions = explode(',', $request->roles_permissions);
        foreach($listOfPermissions as $permission){
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace("","-",$permission));
            $permissions->save();
            $roleStore->permissions()->attach($permissions->id);
            $roleStore->save();
        }
        
        return redirect()->route('roles.index')->with('message','Role has been created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roleShow = Role::findOrFail($id);
        return view('backend.pages.roles.show',compact('roleShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleEdit = Role::findOrFail($id);
        return view('backend.pages.roles.edit',compact('roleEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roleUpdate = Role::findOrFail($id);
        $roleUpdate->name = $request->name;
        $roleUpdate->slug = $request->slug;
        $roleUpdate->save();
        
        $roleUpdate->permissions()->delete();
        $roleUpdate->permissions()->detach();
        $listOfPermissions = explode(',', $request->roles_permissions);
        foreach($listOfPermissions as $permission){
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace("","-",$permission));
            $permissions->save();
            $roleUpdate->permissions()->attach($permissions->id);
            $roleUpdate->save();
        }
        return redirect()->route('roles.index')->with('message','Role has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleDestroy = Role::findOrFail($id);
        $roleDestroy->permissions()->delete();
        $roleDestroy->delete();
        $roleDestroy->permissions()->detach();
        return back();
    }
}
