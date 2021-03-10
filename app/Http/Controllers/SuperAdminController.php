<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;


class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('superadmin.profile.manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $u)
    {
        
         $request->validate([
            'name' => 'required|unique:users|min:3|max:20|',
            'email' => 'required|min:12|max:50'
        ]);

        $user = User::find($request->user_id);

        if ($request->hasFile('feature_image')){

           /*  $existPhoto = '/source/back/profile/'.$user->profileImage;
            $path = str_replace('\\','/',public_path());
            if (file_exists($path.$existPhoto)) {
                \unlink($path.$existPhoto);
            } */
            $image = $request->file('feature_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('source/back/profile'),$imageName);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->profileImage = $imageName;
            $user->update();

        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->profileImage = $user->profileImage;
            $user->update();
        }
        $msg='Profile Updated!';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Profile updated successfully'); 
    }

    public function getPassword()
    {
        return \view('superadmin.profile.getPassword');
    }

    public function updatePassword(Request $req)
    {
        $req->validate([
            'previousPassword' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashPass = Auth::user()->password;

        if (Hash::check($req->previousPassword, $hashPass)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($req->password);
            $user->save();
            Auth::logout();
            $msg='Password Changed!';
            Toastr::success($msg, 'Success.!');
            return redirect('/login')->with('success','Password changed successfully');
        } else {
            $msg='Current password invalid!';
            Toastr::error($msg, 'Success.!');
            return \back()->with('error','current password is invalid');
        }
        
        //return \redirect()->route('user.index')->with('success','Password changed successfully');
    }

   
 
}



