<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserPostController extends Controller
{
    public function request()
    {
        return view('user.request');
    }
    public function storeRequest(Request $request)
    {
        $request->validate([
            'message' => 'required|unique:Userrequest|min:10|max:1000'
        ]);
        
        $user = User::find(Auth::id());
        return $user;
       /*  $request = Userrequest::create([
            'userId'=>Auth::id(),
            'name'=>Auth::name(),
            'email'=>Auth::email(),
            'status'=>'Pending',
            'type'=>Auth::type(),
            'reqType'=>'Author',
            'message'=>$request->message,
            'totalComment'=>Auth::user(),
        ]);

        $msg='Post Created Successfully';
        Toastr::success($msg, 'Success.!');
        return redirect()->route('superadmin.post.singleuser')->with('success','Post created successfully'); */
    }
}
