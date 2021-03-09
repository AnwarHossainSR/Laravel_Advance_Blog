<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where('email','=',$request->email)->first();

            if ($user->type == 'Superadmin') {
                $request->session()->put('loggedUser',$user->id);
                return \redirect('dashboard/superadmin');
            } elseif($user->type == 'Admin') {
                $request->session()->put('loggedUser',$user->id);
                return \redirect('dashboard/admin');
            }elseif($user->type == 'Author'){
                $request->session()->put('loggedUser',$user->id);
                return \redirect('dashboard/author');
            }else{
                $request->session()->put('loggedUser',$user->id);
                return \redirect('dashboard/user');
            }
        }else{
            return back()->with('error','Email or password is incorrect');
        }

    }

    public function superAdminDashboard()
    {
        $data = User::find(session('loggedUser'));
        return view('superadmin.include.home')->with('data',$data);
    }
    public function adminDashboard()
    {
        $data = User::find(session('loggedUser'));
        return view('admin.admin')->with('data',$data);
    }
    public function authorDashboard(Request $req)
    {
        $data = User::find(session('loggedUser'));
 //---------------------Viewing Trash--------------------------
         $ct_trash = Post ::onlyTrashed()->get()->where('user_id',$data->id);
         $trash=$ct_trash->count();
 //---------------------Viewing Trash---------------------------
        return view('author.include.home')->with('data',$data)
                                          ->with('trash',$trash);
    }
    public function userDashboard()
    {
        $data = User::find(session('loggedUser'));
        return view('user.user')->with('data',$data);
    }
}
