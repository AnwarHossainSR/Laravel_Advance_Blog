<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $user=User::find(Auth::id());
        return view('admin.adminprofile')->with('user',$user);
    }
    public function update(Request $req)
    {
        $validation = validator::make($req->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'sometimes|nullable|min:8',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validation->fails()) {
            return redirect()->route('admin.profile')->with('errors', $validation->errors());
        }
        $user=User::find(Auth::id());
        if ($req->hasFile('image')) {

            $existPhoto = 'source/back/profile' . $user->profileImage;
            $path = str_replace('\\', '/', public_path());
            if (file_exists($path . $existPhoto)) {
                \unlink($path . $existPhoto);
            }
            $image = $req->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('source/back/profile'), $imageName);

            if($req->has('password') && $req->password !== null){
                $user->password = bcrypt($req->password);
            }

            $user->name=$req->name;
            $user->email=$req->email;
            $user->profileImage = $imageName;
            $user->save();
            Session::flash('success', 'Profile updated successfully');
        } else {
            $user->name=$req->name;
            $user->email=$req->email;
            if($req->has('password') && $req->password !== null){
                $user->password = bcrypt($req->password);
            }
            $user->save();
            Session::flash('success', 'Profile updated successfully');
        }
        return redirect()->back();
    }
}
