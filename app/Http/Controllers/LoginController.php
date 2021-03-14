<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'active'=>1])) {

            $user = User::where('email', '=', $request->email)->first();

            if ($user->type == 'Superadmin') {
                $request->session()->put('loggedUser', $user->id);
                $msg='Authorized!';
                Toastr::success($msg, 'Authorization successfull.!');
                return \redirect('dashboard/superadmin');
            } elseif ($user->type == 'Admin') {
                $request->session()->put('loggedUser', $user->id);
                $msg='Authorized!';
                Toastr::success($msg, 'Authorization successfull.!');
                return \redirect('dashboard/admin');
            } elseif ($user->type == 'Author') {
                $request->session()->put('loggedUser', $user->id);
                $msg='Authorized!';
                Toastr::success($msg, 'Authorization successfull.!');
                return \redirect('dashboard/author');
            } else {
                $request->session()->put('loggedUser', $user->id);
                $msg='Email or password wrong!';
                Toastr::success($msg, 'Authorization successfull.!');
                return \redirect('dashboard/user');
            }
        } else {
            $msg='Email or password wrong!';
            Toastr::error($msg, 'Error.!');
            return back()->with('error', 'Email or password is incorrect');
        }
    }

    public function superAdminDashboard()
    {
        $data = User::find(session('loggedUser'));
        return view('superadmin.include.home')->with('data', $data);
    }
    public function adminDashboard()
    {
        $postCount = Post::all()->count();
        $categoryCount = Category::all()->count();
        $tagCount = Tag::all()->count();
        $userCount = User::all()->count();
        $data = User::find(session('loggedUser'));
        return view('admin.include.home')->with('post', $postCount)->with('category', $categoryCount)->with('tag', $tagCount)->with('user', $userCount);
    }
    public function authorDashboard(Request $req)
    {
        $data = User::find(session('loggedUser'));
        return view('author.include.home')->with('data', $data);
    }
    public function userDashboard()
    {
        $postCount = Post::all()->count();
        $categoryCount = Category::all()->count();
        $tagCount = Tag::all()->count();
        $userCount = User::all()->count();
        $data = User::find(session('loggedUser'));
        return view('user.user-dashboard')->with('data', $data)->with('post', $postCount)->with('category', $categoryCount)->with('tag', $tagCount)->with('user', $userCount);
        // return view('user.user')->with('data', $data);
    }
}
