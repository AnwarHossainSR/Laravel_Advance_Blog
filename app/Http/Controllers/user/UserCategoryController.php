<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCategoryController extends Controller
{
    public function PostByCategory($id){
        $category = Category::where('id','=',$id)->first()->posts;
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();
        $authors = User::where('type', '=', 'Author')->where('active','=',1)->get();
        $users = User::where('type','=','User')->where('active','=',1)->get();
        return view('user.category-blog',compact('category','catfilter','authors','users'));
    }
}
