<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $tags = Tag::all();
        return view('superadmin.post.post_add_form',compact('categories','tags'));
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
            'categories'=>'required',
            'tags'=>'required',
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
            'user_id'=>Auth::id(),
            'postImage'=>$imageName,
            'status'=>$request->status,
            'is_approve'=>$request->is_approve,
        ]);

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        return redirect()->route('superadmin.post.singleuser')->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return \view('superadmin.post.detailsPost',\compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status',1)->get();
        $tags = Tag::all();
        return view('superadmin.post.editPost',compact('post','categories','tags'));
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
        return redirect()->route('superadmin.post.singleuser')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Post $post)
    {
        $existPhoto = '/source/back/post/' . $post->postImage;
        $path = str_replace('\\', '/', public_path());
        if (file_exists($path . $existPhoto)) {
            \unlink($path . $existPhoto);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
      // return back()->with('success','Post deleted successfully');
    }

    public function hide($id)
    {
        $post = Post::find($id);
        $post->status = 'Unpublish';
        $post->save();
        return back()->with('success','Post hide successfully');
    }
    public function publish($id)
    {
        $post = Post::find($id);
        $post->status =  'Publish';
        $post->save();
        return back()->with('success','Post publish successfully');
    }

    public function getAllPostBySuperAdmin()
    {
        $posts = Post::where('user_id','=',Auth::id())->get();
        return \view('superadmin.post.singleUserManage',\compact('posts'));
    }
}
