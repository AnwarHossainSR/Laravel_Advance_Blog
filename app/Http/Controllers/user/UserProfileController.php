<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function AuthorProfile($id){
        $categories = Category::where('status','=',1)->latest()->get();
        //$catfilter = Category::where('status','=',1)->take(-3)->get();
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();
        $author = User::find($id);
        $authors = User::where('active','=',1)->get()->random(5);
        // return $author;
        $posts=Post::where([['status','=','Publish'],['is_approve','=',1],['user_id','=',$id]])->latest()->get();
         //return $posts->count();
        return view('user.single-author-profile',compact('posts','categories','catfilter','author', 'authors'));
    }

    public function index()
    {
        $user=User::find(Auth::id());
        return view('user.profile')->with('user',$user);
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
            return redirect()->route('user.profile')->with('errors', $validation->errors());
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
