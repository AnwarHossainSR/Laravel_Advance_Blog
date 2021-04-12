<?php

namespace App\Http\Controllers\author;

use Carbon\Carbon;
use App\Models\Post;
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
       $total_trash_post = Post::onlyTrashed()->where('user_id',Auth::user()->id)->count();
        return view('author.author_profile')->with('author',$author)
                                            ->with('total_trash_post',$total_trash_post);
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

        if ($request->hasFile('image')){

            $oldPic = '/source/back/profile/'.$user->profileImage;
            $path = str_replace('\\','/',public_path());
            if (file_exists($path.$oldPic)) {
                \unlink($path.$oldPic);
            }
            $image = $request->file('image');
            $imgName = time().'.'.$image->extension();
            $image->move(public_path('source/back/profile'),$imgName);
			
			
           $user->name = $request->name;
           $user->email = $request->email;
           $user->profileImage = $imgName;
           $user->about= $request->Info;
           $user->save();
			
	}
	
	else
	{
		   $user->name = $request->name;   //will execute when profile image not changed
           $user->email = $request->email;
           $user->profileImage = $user->profileImage;
           $user->about= $request->Info;
           $user->save();
	}

           $msg='Profile Updated Successfully';
           Toastr::success($msg, 'Success.!');

           return redirect()->back();



    }
}
