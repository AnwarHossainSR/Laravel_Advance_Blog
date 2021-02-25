<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

            if (!$user) {
                return back()->with('error','email is not recorded');
            } else {
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
            }

        }else{
            return back()->with('error','Password is incorrect');
        }

    }

    public function superAdminDashboard()
    {
        $data = ['loggedUserInfo'=>User::where('id','=',session('loggedUser'))->first()];
        return view('users.superadmin',$data);
    }
    public function adminDashboard()
    {
        $data = ['loggedUserInfo'=>User::where('id','=',session('loggedUser'))->first()];
        return view('users.admin',$data);
    }
    public function authorDashboard(Request $req)
    {
        $data = ['loggedUserInfo'=>User::where('id','=',session('loggedUser'))->first()];

        return view('users.author',$data);
    }
    public function userDashboard()
    {
        $data = ['loggedUserInfo'=>User::where('id','=',session('loggedUser'))->first()];
        return view('users.user',$data);
    }
}
