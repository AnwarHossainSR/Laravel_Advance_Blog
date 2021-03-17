<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class SearchController extends Controller
{
    public function searchController(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where([['title','LIKE',"%$query%"],['status','=','Publish'],['is_approve','=',1]])->get();
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();
        $authors = User::where('type', '=', 'Author')->where('active','=',1)->get();
        return view('user.search',compact('posts','query','catfilter','authors'));
    }
}
