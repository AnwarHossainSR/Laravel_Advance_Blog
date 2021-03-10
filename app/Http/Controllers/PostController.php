<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

>>>>>>> 7c60a22496e414c41c301686c59dc80ea5dfb219

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('superadmin.post.post_manage',compact('posts',$posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('superadmin.post.post_add_form',compact('categories',$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|min:5|max:255',
            'excerpt' => 'required|unique:posts|min:5|max:255',
            'content' => 'required|min:10|unique:posts',
        ]);

        if ($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('source/back/post'),$imageName);
        }else{
            $imageName = "postDefault.jpg";
        }

        $post = Post::create([
            'title'=>$request->title,
            'slug'=>strtolower(str_replace('','_',$request->title)),
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id,
            'postImage'=>$imageName,
        ]);

<<<<<<< HEAD
        return redirect()->route('post.index')->with('success','Post created successfully');
=======
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $msg='Post Created Successfully';
        Toastr::success($msg, 'Success.!');
        return redirect()->route('superadmin.post.singleuser')->with('success','Post created successfully');
>>>>>>> 7c60a22496e414c41c301686c59dc80ea5dfb219
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
<<<<<<< HEAD
        //
=======
        $request->validate([
            'title' => 'required|min:5|max:255',
            'excerpt' => 'required|min:5|max:255',
            'content' => 'required|unique:posts',
            'categories'=>'required',
            'tags'=>'required',
        ]);

        //$cate = Category::find($request->id);

        if ($request->hasFile('feature_image')) {

            $existPhoto = '/source/back/post/' . $post->postImage;
            $path = str_replace('\\', '/', public_path());
            if (file_exists($path . $existPhoto)) {
                \unlink($path . $existPhoto);
            }
            $image = $request->file('feature_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('source/back/post'), $imageName);

            $post->title = $request->title;
            $post->slug = strtolower(str_replace('', '_', $request->title));
            $post->excerpt = $request->excerpt;
            $post->content = $request->excerpt;
            $post->user_id = Auth::id();
            $post->postImage = $imageName;
            $post->status = $request->status;
            $post->is_approve = $request->is_approve;
            $post->update();
            $post->categories()->sync($request->categories);
            $post->tags()->sync($request->tags);
           
        } else {
            $post->title = $request->title;
            $post->slug = strtolower(str_replace('', '_', $request->title));
            $post->excerpt = $request->excerpt;
            $post->content = $request->excerpt;
            $post->user_id = Auth::id();
            $post->status = $request->status;
            $post->is_approve = $request->is_approve;
            $post->update();
            $post->categories()->sync($request->categories);
            $post->tags()->sync($request->tags);
        }
        $msg='Post Updated Successfully';
        Toastr::success($msg, 'Success.!');
        return redirect()->route('superadmin.post.singleuser')->with('success', 'Post updated successfully');
>>>>>>> 7c60a22496e414c41c301686c59dc80ea5dfb219
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
<<<<<<< HEAD
       Post::destroy($id);
       return back()->with('success','Post deleted successfully');
=======
        $existPhoto = '/source/back/post/' . $post->postImage;
        $path = str_replace('\\', '/', public_path());
        if (file_exists($path . $existPhoto)) {
            \unlink($path . $existPhoto);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        $msg='Post Deleted Successfully';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Post deleted successfully');
>>>>>>> 7c60a22496e414c41c301686c59dc80ea5dfb219
    }

    public function hide($id)
    {
        $post = Post::find($id);
        $post->status = 'Unpublish';
        $post->save();
        $msg='Post Hide Successfully';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Post hide successfully');
    }
    public function publish($id)
    {
        $post = Post::find($id);
        $post->status =  'Publish';
        $post->save();
        $msg='Post Published Successfully';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Post publish successfully');
    }
}
