<?php

namespace App\Http\Controllers\author;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AuthorProfileController extends Controller
{
    public function view_profile() 
    {
       //$author= User::all()->where('name');
       $author = User::find(session('loggedUser'));
        return view('author.author_profile')->with('author',$author);
    }    
    
    public function save_profile(Request $request) 
    {
        //return $request;
        //Update Author Profile Section

        $request->validate([
            'name' => 'required',    //|unique:users|alpha
            'email' => 'required|email',
            'profileImage' => 'mimes:jpg,bmp,png',//required|
        ]);
        
        $id= Auth::user()->id;
       
        $user = User::find($id);


        $img=  $request->file('image');

        if(isset($img))        // if image data inserted
        {
            $currentDate= Carbon ::now()->toDateString();

            $imgName='author'.'_'.$currentDate.'_'.uniqid().'.'.$img->getClientOriginalExtension();


            //Checking directory existance
            if(!Storage::disk('public')->exists('author_img'))
            {
                Storage::disk('public')->makeDirectory('author_img');
            }
            //Checking Duplicate filename existance

            if(Storage::disk('public')->exists('author_img/'.$user->profileImage))
            {
                Storage::disk('public')->delete('author_img/'.$user->profileImage);
            }

               
            $resized_img= Image::make($img)->resize(128,128)->stream();//->save()

             Storage::disk('public')->put('author_img/'.$imgName,$resized_img);

        }

        else
        {
            $imgName= $user->profileImage;          // 'default.jpg';
        }

           // $user = new User();

           $user->name = $request->name;
           $user->email = $request->email;
           $user->profileImage = $imgName;
           $user->save();

           $msg='Profile Updated Successfully';
           Toastr::success($msg, 'Success.!');

           return redirect()->back();



    }
}
