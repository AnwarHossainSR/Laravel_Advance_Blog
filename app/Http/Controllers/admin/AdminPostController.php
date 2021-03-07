<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.post.index')->with('posts', $post);
    }
}
