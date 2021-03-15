<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class UserPostController extends Controller
{
    public function favourite()
    {
        $user=User::find(Auth::id());
        $posts = $user->favorite_posts;
        return view('user.favourite-post')->with('posts', $posts);
    }
}
