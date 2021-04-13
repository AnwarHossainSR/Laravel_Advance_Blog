<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Comment;

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
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
                            ->withCount('favorite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
        $total_pending_posts = Post::where('is_approve','=',0)->count();
        $all_views = Post::sum('view_count');
        $author_count = User::where('type','=','Author')->count();
        $admin_count = User::where('type','=','Admin')->count();
        $admin_count = User::where('type','=','User')->count();
        $new_user_today = User::where('type','=','User')
                                ->whereDate('created_at',Carbon::today())->count();
       $active_authors = User::where('type','=','Author')
                                ->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favorite_posts')
                                ->orderBy('posts_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favorite_posts_count','desc')
                                ->take(10)->get();
       $category_count = Category::all()->count();
       $tag_count = Tag::all()->count();

       //chart
       $users = Post::select(DB::raw('COUNT(*) as count'))
                                ->whereYear('created_at',date('Y'))
                                ->groupBy(DB::raw('Month(created_at)'))
                                ->pluck('count');
        $months = Post::select(DB::raw('Month(created_at) as month'))
                                   ->whereYear('created_at',date('Y'))
                                   ->groupBy(DB::raw('Month(created_at)'))
                                   ->pluck('month');
        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months as $index => $month) {
            $datas[$month-1]=$users[$index];
        }

        return view('superadmin.include.home',\compact('data','posts','popular_posts','total_pending_posts','all_views','author_count','new_user_today','active_authors','category_count','tag_count'))->with('datas',json_encode($datas));
    }
    public function adminDashboard()
    {
        $data1 =DB::table('users')->select(DB::raw('type as type'),DB::raw('count(*) as number'))->groupBy('type')->get();
        $array[] = ['User', 'Number'];
        foreach($data1 as $key => $value)
        {
            $array[++$key] = [$value->type, $value->number];
        }
        $users =DB::table('posts')->select(DB::raw('COUNT(*) as count'))->whereYear('created_at',date('Y'))->groupBy(DB::raw('Month(created_at)'))->pluck('count');
        $months =DB::table('posts')->select(DB::raw('Month(created_at) as month'))->whereYear('created_at',date('Y'))->groupBy(DB::raw('Month(created_at)'))->pluck('month');
        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months as $index => $month) {
            $datas[$month]=$users[$index];
        }
        $postCount = Post::all()->count();
        $categoryCount = Category::all()->count();
        $tagCount = Tag::all()->count();
        $userCount = User::all()->count();
        $data = User::find(session('loggedUser'));
        return view('admin.include.home')->with('post', $postCount)->with('category', $categoryCount)->with('tag', $tagCount)->with('user', $userCount)->with('type', json_encode($array))->with('datas',json_encode($datas));
    }
    public function authorDashboard(Request $req)
    {
        $data = User::find(session('loggedUser'));
        return view('author.include.home')->with('data', $data);
    }
    public function userDashboard()
    {
        // $user=User::find(Auth::id());
        // $posts = $user->favorite_posts;
        // $data = User::find(session('loggedUser'));
        $user=User::find(Auth::id());
        $posts = $user->favorite_posts;

        $comments = Comment::where('user_id','=',Auth::id())->latest()->get();

        // $weekPosts = $user->favorite_posts->whereDate('created_at', Carbon::now()->subDays(60));

        // return $weekPosts;

        // $weekComments = Comment::where('user_id','=',Auth::id())->latest()->where('created_at', Carbon::now()->subDays(7))->get();


        $data = User::find(session('loggedUser'));
        return view('user.user-dashboard')->with('posts', $posts)->with('comments', $comments);
    }

    //Forgot Password portion

    public function forgotPasswordEmailForm(Request $req)
    {
        return \view('auth.passwords.forgotPasswordEmailForm');
    }
    public function checkEMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user->count() > 0) {

            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();
            Mail::send('auth.passwords.verify',['token' => $token,'email' => $user->email], function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
             });
            $msg='Success!';
            Toastr::success($msg, 'Password link sent.!');
            return \back()->with('success','Password confirmation link is sent to your email');
        } else {
            $msg='Wrong email!';
            Toastr::error($msg, 'Error.!');
            return back()->with('error', 'User does not exist');
        }

    }
    public function forgotPassword($token,$email)
    {
        return \view('auth.passwords.passwordForgot', ['token' => $token,'email' => $email]);
    }

    public function updateForgotPassword(Request $req)
    {
        $req->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', '=', $req->email)->first();
        if ($user->remember_token === $req->customtoken) {
            $user->password = Hash::make($req->password);
            $user->remember_token = '';
            $user->save();
            $msg='Password Changed!';
            Toastr::success($msg, 'Success.!');
            return redirect()->route('login')->with('success','Password changed successfully');
        } else {
            $msg='Wrong!';
            Toastr::success($msg, 'Error.!');
            return back()->with('error','Token is not matched with server');
        }
    }
}
