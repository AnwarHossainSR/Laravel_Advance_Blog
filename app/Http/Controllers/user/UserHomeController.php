<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    // All Post
    public function index()
    {
        $posts=Post::get();
        // return $post;
        return view('user.home')->with('posts',$posts);
    }

    public function singleBlog($id)
    {
        $post = Post::find($id);
        return view('user.single-blog')->with('post',$post);
    }
}
