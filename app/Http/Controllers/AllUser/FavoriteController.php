<?php

namespace App\Http\Controllers\AllUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;


class FavoriteController extends Controller
{
    public function add(Post $post)
    {
        //return $post->id;
        $user = Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id','=',$post->id)->count();
        //return $isFavorite;
        if ($isFavorite == 0) {
            $user->favorite_posts()->attach($post);
            Toastr::success('Post successfully added to your favorite list :)','Success');
            return redirect()->back();
        } else {
            $user->favorite_posts()->detach($post);
            Toastr::success('Post successfully removed form your favorite list :)','Success');
            return redirect()->back();
        }
    }

    public function userFavouritePost()
    {
        /* $postCount = Post::all()->count();
        $categoryCount = Category::all()->count();
        $tagCount = Tag::all()->count();
        $userCount = User::all()->count(); */
        $user=User::find(Auth::id());
        $posts = $user->favorite_posts;
        $data = User::find(session('loggedUser'));
        return view('user.favourite-posts',\compact('posts', $posts));
        // return view('user.user')->with('data', $data);
    }
}
