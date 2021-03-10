<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class UserController extends Controller
{
    // All Post
    public function index()
    {
        $posts=Post::get();
        // return $post;
        return view('user.home')->with('posts',$posts);
    }

    public function singleBlog()
    {
        return view('user.single-blog');
    }
}
