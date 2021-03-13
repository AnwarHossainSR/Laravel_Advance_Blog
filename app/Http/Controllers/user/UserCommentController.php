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
}
