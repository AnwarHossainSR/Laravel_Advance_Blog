<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Userrequest;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('active','=',1)->get();
        return \view('superadmin.usermanage.manage',['users'=>$users]);
    }
   
    public function getAllRoles()
    {
        $roles = Role::all();
        return \view('superadmin.usermanage.roleManage',['roles'=>$roles]);
    }

    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('superadmin.usermanage.roleCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required|unique:roles|min:2|max:20',
        ]);
        $role = new Role();
        $role->roleName = $request->roleName;
        $role->save();
        return redirect()->route('role.manage')->with('success','User role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return \view('superadmin.usermanage.detailsUser',\compact('user',$user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        return \view('superadmin.usermanage.editRole',['roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $user = User::find($id);
        $user->type = $req->type;
        $user->update();
        return \redirect()->route('user.manage')->with('success','User role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllDeactiveUsers()
    {
        $users = User::where('active','=',0)->get();
        return \view('superadmin.usermanage.deactiveUsers',['users'=>$users]);
    }
    
    public function activeToDeactive($id)
    {
        $user = User::find($id);
        $user->active = 0;
        $user->update();
        return \back()->with('success','User status is changed to deactive successfull');
    }
    public function deactiveToActive($id)
    {
        $user = User::find($id);
        $user->active = 1;
        $user->update();
        return \back()->with('success','User restored successfully done');
    }

    public function requestUserHandle()
    {
        $reqUser = Userrequest::where('status','=','Pending')->get();
        return \view('superadmin.usermanage.userRequest',['users'=>$reqUser]);
    }

    public function requestDetailsShow($id)
    {
        $user = Userrequest::find($id);
        return \view('superadmin.usermanage.userRequestDetails',\compact('user',$user)); 
    }
    public function requestUserAccept($id)
    {
        $reqUser = Userrequest::where('userId','=',$id)->get();
        $user = User::find($id);
        $reqUser->status = 'Accept';
        $user->type = 'Author';
        $user->update();
        $reqUser->update();
        return \redirect()->route('request.user')->with('success','User role has been changed successfully'); 
    }
    
}


