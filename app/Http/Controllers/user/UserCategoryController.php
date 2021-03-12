<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function PostByCategory($id){
        $categories = Category::where('status','=',1)->latest()->get();
        //$catfilter = Category::where('status','=',1)->take(-3)->get();
        $catfilter = Category::orderBy('id', 'desc')->take(14)->get();

        $posts=Post::where([['status','=','Publish'],['is_approve','=',1]])->latest()->get();
        $posts = DB::table('posts')
        ->join('categories', 'posts')
        // $benefit= DB::table('benefits')
        // ->join('benefit_provider_companies', 'benefits.bpc_id', '=', 'benefit_provider_companies.id')
        // ->select('benefits.id', 'benefits.benefit_name', 'benefits.benefit_detail','benefits.benefit_percentage','benefits.benefit_startsin',
        //          'benefits.benefit_endsin','benefits.benefit_catagory', 'benefits.created_at', 'benefits.updated_at', 'benefit_provider_companies.id', 
        //          'benefit_provider_companies.bpc_name', 'benefit_provider_companies.bpc_email', 'benefit_provider_companies.bpc_contact_person_name', 
        //          'benefit_provider_companies.bpc_contact_person_phone', 'benefit_provider_companies.bpc_contact_person_email', 'benefit_provider_companies.bpc_photo', 
        //          'benefit_provider_companies.created_at', 'benefit_provider_companies.updated_at')
        // ->where('benefits.benefit_catagory','my_deals')
        // ->get();
        $authors = User::where('type','=','Author')->where('active','=',1)->get();
        $users = User::where('type','=','User')->where('active','=',1)->get();
         //return $posts->count();
        return view('user.home',compact('posts','categories','catfilter','authors','users'));
    }
}
