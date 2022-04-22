<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('backend.pages.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        if($request->ajax()){
            $roles = Role::where('id',$request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }
        $all_role = Role::all();
        return view('backend.pages.users.create',compact('all_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
      //validate the field
    //   $request->validate([
    //       'name' => 'required|max:255',
    //       'email' => 'required|unique:users|email|max:255',
    //       'password' => 'required|between:8,255|confirmed',
    //       'password_confirmation' => 'required'
    //   ],[
    //      'name.required' => 'Please enter the user name',
    //      'email.required' => 'Please enter the user email',
    //      'password.required' => 'Please enter the password',
    //   ]);
    
        $userCreate = new User();
        $userCreate->name = $request->name;
        $userCreate->email = $request->email;
        $userCreate->password = Hash::make($request->password);
        $userCreate->save();

        if($request->role != null){
            $userCreate->roles()->attach($request->role);
            $userCreate->save();
        }
        if($request->permissions != null){
            foreach($request->permissions as $permission){
                $userCreate->permissions()->attach($permission);
                $userCreate->save();
            }
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userShow = User::findOrFail($id);
        return view('backend.pages.users.show',compact('userShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userEdit = User::findOrFail($id);
        $roles = Role::get();
        $userRole = $userEdit->roles->first();
        $rolePermissions = $userRole->allPermissions;
        $userPermissions = $userEdit->permissions;
        return view('backend.pages.users.edit',compact('userEdit','roles','userRole','rolePermissions','userPermissions'));
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
              //validate the field
      $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:users|email|max:255',
        'password' => 'between:8,255|confirmed',
    ],[
       'name.required' => 'Please enter the user name',
       'email.required' => 'Please enter the user email',
       'password.required' => 'Please enter the password'
    ]);
        $userUpdate = User::findOrFail($id);
        $userUpdate->name = $request->input('name');
        $userUpdate->email = $request->input('email');
        if($request->password !=null){
            $userUpdate = Hash::make($request->password);
        }
        $userUpdate->save();
        return redirect()->route('users.index')->with('message','User has been updated successfully!!');
    }

    /**
     * Re
     * if()move the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $userDestroy = User::findOrFail($id);
       $userDestroy->delete();
       return back();
    }
}
