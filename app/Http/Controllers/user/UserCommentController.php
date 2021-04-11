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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserCommentController extends Controller
{
    public function Store(Request $request, $post){
        $this->validate($request,[
            'comment'=>'required'
        ]);
        $comment = new Comment();
        $comment->user_id = session('loggedUser');
        $comment->post_id = $post;
        $comment->comment = $request->comment;

        $comment->save();
        Toastr::success('Comment Successfully Published', 'Success');
        return redirect()->back();
    }
    public function Delete($id){
        
        $comment = Comment::find($id);
        
        $comment->delete();
        $msg='Comment Deleted';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Comment deleted successfully');
    }

    public function commentsByUser(){
        $comments = Comment::where('user_id','=',Auth::id())->latest()->get();
        return view('user.comments-by-user', compact('comments'));
        
    }

    
}
