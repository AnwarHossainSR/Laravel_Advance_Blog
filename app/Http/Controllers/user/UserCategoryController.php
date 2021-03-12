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
        $categories = Category::where('status','=',1)->latest()->get();
        //$catfilter = Category::where('status','=',1)->take(-3)->get();
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();

        // $posts=Post::where([['status','=','Publish'],['is_approve','=',1]])->latest()->get();
        $posts = DB::table('category_post')
        ->join('posts', 'posts.id', '=', 'category_post.post_id')
        ->join('categories','categories.id','=','category_post.category_id')
        ->where('category_post.category_id','=',$id)
        ->get();

        //return $posts;
        
        $authors = User::where('type', '=', 'Author')->where('active','=',1)->get();
        $users = User::where('type','=','User')->where('active','=',1)->get();
         //return $posts->count();
        return view('user.category-blog',compact('posts','categories','catfilter','authors','users'));
    }
}
