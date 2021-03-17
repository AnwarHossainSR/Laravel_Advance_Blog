<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminApproval;
use App\Mail\AdminReject;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use App\Notifications\AdminPostApprove;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Notifications\superAdmin\NewPostNotification;

class AdminPostController extends Controller
{
    public function index()
    {
        $post = Post::where('is_approve',1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.post.index')->with('posts', $post);
    }
    public function ownindex()
    {
        $post = Post::where('user_id',Auth::id())->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.post.index')->with('posts', $post);
    }
    public function create()
    {
        $category = Category::all();
        $tag = Tag::all();
        return view('admin.post.create')->with('categories', $category)->with('tags', $tag);;
    }
    public function createPost(Request $req)
    {
        $validation = validator::make($req->all(), [
            'title' => 'required|min:3|unique:posts,title',
            'slug' => 'required|min:3',
            'excerpt' => 'required|min:4',
            'content' => 'required|min:5',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validation->fails()) {
            return redirect()->route('admin.post.create')->with('errors', $validation->errors())->withInput();
        }
        $category = Category::first();
        $files = $req->file('file');
        $files->move('source/back/post', $files->getClientOriginalName());
        $post = new Post();
        $post->title = $req->title;
        $post->slug = Str::slug($req->title, '-');
        $post->excerpt = $req->excerpt;
        $post->content = $req->content;
        $post->category_id = $category->id;
        $post->user_id = Auth::id();
        $post->postImage = $files->getClientOriginalName();
        $post->status = "Publish";
        $post->is_approve=1;
        $post->save();
        $post->categories()->attach($req->categories);
        $post->tags()->attach($req->tags);
        $id = 1;
        User::find($id)->notify(new NewPostNotification($post));
        Session::flash('success', 'Post created successfully');
        //return redirect()->route('admin.category.all');
        return redirect()->back();
    }
    public function edit($id)
    {
        $post = Post::find($id);
        $tag = Tag::all();
        $cat = Category::find($post->category_id);
        $category = Category::all();
        return view('admin.post.edit')->with('posts', $post)->with('cat', $cat)->with('categories', $category)->with('tags', $tag);
    }
    public function editPost($id, Request $req)
    {
        $validation = validator::make($req->all(), [
            'title' => 'required',
            'slug' => 'required|min:3',
            'excerpt' => 'required|min:4',
            'content' => 'required|min:5',
        ]);
        if ($validation->fails()) {
            return Back()->with('errors', $validation->errors());
        }
        $post = Post::find($req->id);

        if ($req->hasFile('file')) {

            $existPhoto = 'source/back/post' . $post->postImage;
            $path = str_replace('\\', '/', public_path());
            if (file_exists($path . $existPhoto)) {
                \unlink($path . $existPhoto);
            }
            $image = $req->file('file');
            $category = Category::first();
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('source/back/post'), $imageName);

            $post->title = $req->title;
            $post->slug = Str::slug($req->title, '-');
            $post->excerpt = $req->excerpt;
            $post->content = $req->content;
            $post->category_id = $category->id;
            $post->user_id = $post->user_id;
            $post->postImage = $imageName;
            $post->status = "Publish";
            $post->save();
            $post->categories()->sync($req->category);
            $post->tags()->sync($req->tags);
            $id = 1;
            User::find($id)->notify(new NewPostNotification($post));
            Session::flash('success', 'Post updated successfully');
        } else {
            $post->title = $req->title;
            $post->slug = Str::slug($req->title, '-');
            $post->excerpt = $req->excerpt;
            $post->content = $req->content;
            $post->category_id = 3;
            $post->user_id = $post->user_id;
            $post->status = "Publish";
            $post->save();
            $post->categories()->sync($req->category);
            $post->tags()->sync($req->tags);
            $id = 1;
            User::find($id)->notify(new NewPostNotification($post));
            Session::flash('success', 'Post updated successfully');
        }
        return redirect()->back();
        //return view('admin.category.edit')->with('categories', $category);
    }
    public function delete($id)
    {
        $post=Post::find($id);
        if($post){
            if(file_exists(public_path($post->postImage))){
                unlink(public_path($post->postImage));
            }
            $post->tags()->detach();
            $post->delete();
            Session::flash('success', 'Post deleted successfully');
            return redirect()->route('admin.posts.all');
        }

    }
    public function details($id)
    {
        $post = Post::find($id);
        $cat = Category::find($post->category_id);
        $user = User::find($post->user_id);
        return view('admin.post.details')->with('posts', $post)->with('category', $cat)->with('user', $user);
    }
    public function pending()
    {
        $post = Post::where('is_approve',0)->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.post.pending')->with('posts',$post);
    }
    public function approve($id)
    {
        $details=[
            'title'=>'Mail from blog website',
            'body'=>'Your post has been approved by Admin.'
        ];
        $post = Post::find($id);
        $user=User::find($post->user_id);
        $post->is_approve=1;
        $post->save();
        Mail::to($user->email)->send(new AdminApproval($details));
        $id = 1;
        User::find($id)->notify(new NewPostNotification($post));
        Session::flash('success', 'Post approved');
        return redirect()->back();
    }
    public function deny($id)
    {
        $details=[
            'title'=>'Mail from blog website',
            'body'=>'Your post has been denied by Admin.'
        ];
        $post = Post::find($id);
        $user=User::find($post->user_id);
        $post->is_approve=2;
        $post->save();
        Mail::to($user->email)->send(new AdminReject($details));
        Session::flash('success', 'Post denyed by admin');
        return redirect()->back();;
    }
    public function pendingDetails($id)
    {
        $post = Post::find($id);
        $cat = Category::find($post->category_id);
        $user = User::find($post->user_id);
        return  view('admin.post.pendingdetail')->with('posts',$post)->with('category', $cat)->with('user', $user);
    }
    public function favourite()
    {
        $user=User::find(Auth::id());
        $posts = $user->favorite_posts;
        return view('admin.post.favourite')->with('posts', $posts);
    }
    public function favouriteRemove($id)
    {
        DB::table('post_user')->where('post_id',$id)->delete();
        Session::flash('success', 'Post deleted successfully from your Favourite list');
        return redirect()->Back();
    }
    // public function search(Request $request){
    //     if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = DB::table('posts')
    //      ->where('title', 'like', '%'.$query.'%')
    //      ->orWhere('excerpt', 'like', '%'.$query.'%')
    //      ->orderBy('created_at', 'DESC')
    //      ->get();

    //   }
    //   else
    //   {
    //    $data = DB::table('posts')
    //      ->where('is_approve',1)
    //      ->orderBy('created_at', 'DESC')
    //      ->get();
    //   }
    //   $total_row = $data->count();
    //   if($total_row > 0)
    //   {
    //    foreach($data as $row)
    //    {
    //     $output .= '
    //     <tr>
    //      <td>'.$row->id.'</td>
    //      <td>'.$row->title.'</td>
    //      <td>'.$row->slug.'</td>
    //      <td>'.$row->excerpt.'</td>
    //      <td>'."tags".'</td>
    //      <td>'.$row->category_id.'</td>
    //      <td>'.$row->user_id.'</td>
    //      <td>'."Published".'</td>
    //      <td>'."Default".'</td>
    //      <td>'."Default".'</td>
    //     </tr>
    //     ';
    //    }
    //   }
    //   else
    //   {
    //    $output = '
    //    <tr>
    //     <td align="center" colspan="5">No Data Found</td>
    //    </tr>
    //    ';
    //   }
    //   $data = array(
    //    'table_data'  => $output,
    //   );

    //   echo json_encode($data);
    //  }
    //}
}
