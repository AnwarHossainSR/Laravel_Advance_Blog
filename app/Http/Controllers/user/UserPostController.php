<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\superAdmin\NewUserNotification;

class UserPostController extends Controller
{
    public function request()
    {
        return view('user.request');
    }
    public function storeRequest(Request $request)
    {
        $request->validate([
            'message' => 'required|min:10|max:1000'
        ]);
        
        $user = User::find(Auth::id());
        $request = Userrequest::create([
            'userId'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'status'=>'Pending',
            'type'=>$user->type,
            'reqType'=>'Author',
            'message'=>$request->message,
            'totalComment'=>$user->comments->count(),
            'profileImage'=>$user->profileImage,
            'joind'=>$user->created_at,
        ]);

        $msg='Request Sent';
        Toastr::success($msg, 'Success.!');
        $id = 1;
        User::find($id)->notify(new NewUserNotification());
        return redirect()->route('user.dashboard')->with('success','Request Sent successfully');
    }
}
