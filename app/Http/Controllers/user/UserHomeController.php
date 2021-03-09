<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    // All Post
    public function index()
    {
        $categories = Category::where('status','=',1)->latest()->get();
        $catfilter = Category::where('status','=',1)->take(-8)->get();
        $posts=Post::where([['status','=','Publish'],['is_approve','=',1]])->latest()->get();
         //return $posts->count();
        return view('user.home',compact('posts','categories','catfilter'));
    }

    public function singleBlog($id)
    {
        $post = Post::find($id);
        $catfilter = Category::where('status','=',1)->take(-8)->get();
        return view('user.single-blog',compact('post','catfilter'));
    }
}
