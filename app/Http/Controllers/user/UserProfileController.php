<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function AuthorProfile($id){
        $categories = Category::where('status','=',1)->latest()->get();
        //$catfilter = Category::where('status','=',1)->take(-3)->get();
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();
        $author = User::find($id);
        $authors = User::where('type','=','Author')->where('active','=',1)->get();
        // return $author;
        $posts=Post::where([['status','=','Publish'],['is_approve','=',1],['user_id','=',$id]])->latest()->get();
         //return $posts->count();
        return view('user.single-author-profile',compact('posts','categories','catfilter','author', 'authors'));
    }
}
