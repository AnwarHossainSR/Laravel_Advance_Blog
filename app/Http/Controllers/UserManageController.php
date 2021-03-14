<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Userrequest;
use App\Notifications\UserRequest as NotificationsUserRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Notifications\Notification;
use App\Mail\UserRequestApproval;
use App\Mail\UserRequestCancell;
use Illuminate\Support\Facades\Mail;

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
        $msg='Role Created Successfully';
        Toastr::success($msg, 'Success.!');
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
        $user = User::find($id);
        $roles = Role::all();
        return \view('superadmin.usermanage.editRole',['roles'=>$roles,'user'=>$user]);
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
        $msg='Role Updated Successfully';
        Toastr::success($msg, 'Success.!');
        return \redirect()->route('manage.index')->with('success','User role updated successfully');
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
        $msg='User deactivated';
        Toastr::success($msg, 'Success.!');
        return \back()->with('success','User status is changed to deactive successfull');
    }
    public function deactiveToActive($id)
    {
        $user = User::find($id);
        $user->active = 1;
        $user->update();
        $msg='User Active Successfully';
        Toastr::success($msg, 'Success.!');
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
        $userComments = User::find($user->userId);
        return \view('superadmin.usermanage.userRequestDetails',\compact('user','userComments')); 
    }
    public function requestUserAccept($id)
    {
        $reqUser = Userrequest::find($id);
        $details=[
            'name'=>$reqUser->name,
            'title'=>'Mail from Bona Blogging',
            'body'=>'Your request to author has been successfully accepted. Now you can post yourself. welcom to Bona blogging Author Community'
        ];
        
        $reqUser->status = 'Accepted';
        if($reqUser->save())
        {
            $user = User::find($reqUser->userId);
            $user->type = 'Author';
            $user->save();
            Mail::to($user->email)->send(new UserRequestApproval($details));
        }
        else
        {
            $msg='Something wrong !';
            Toastr::error($msg, 'Error.!');
            return \back()->with('error','Something is wrong !');
        }
        $msg='Role Changed Successfully';
        Toastr::success($msg, 'Success.!');
        return \redirect()->route('request.user')->with('success','User role has been changed successfully'); 
    }
    public function requestUserCancell($id)
    {
        $reqUser = Userrequest::find($id);
        $details=[
            'name'=>$reqUser->name,
            'title'=>'Cancellation Notice',
            'body'=>'Your request to author has been Cancelled due to some issue.'
        ];
        
        $reqUser->status = 'Cancelled';
        if($reqUser->save())
        {
            Mail::to($reqUser->email)->send(new UserRequestCancell($details));
        }
        else
        {
            $msg='Something wrong !';
            Toastr::error($msg, 'Error.!');
            return \back()->with('error','Something is wrong !');
        }
        $msg='Request cancelled';
        Toastr::success($msg, 'Success.!');
        return \redirect()->route('request.user')->with('success','Request cancelled successfully'); 
    }
    
}


