<?php

namespace App\Http\Controllers\author;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Notifications\superAdmin\NewPostNotification;

class AuthorPostController extends Controller
{
    public function add_post()
    {
       
       
        $categories = Category::where('status',1)->get();
        //$categories = Category::all();
        $tags= Tag::all();
        return view('author.post.add_post')->with('categories', $categories)
                                            ->with('tags',$tags);
    }  



    public function all_post_show()
    {
       
        $author = User::find(session('loggedUser'));
       // return dd($author->id);
        $post_info = Post ::orderBy('created_at','DESC')->get()->where('user_id',$author->id);
       // $post_info = Category :: latest()->get()->where('user_id',$author->id);
          //return dd($post_info->categories);
       return view('author.post.all_post_show',compact('post_info'));

      
    } 
        public function get_edit_post( Request $request,$id )
    {
       
     $post = post:: find($id);
     $categories = category::all();
     $tags= Tag::all();
      return view('author.post.edit_post')->with('post',$post)
                                          ->with('categories',$categories)
                                          ->with('tags',$tags);
         // dd($request->all());
      
    } 
    
    
        public function view_all_unpublished_post()
    {
       
        $author = User::find(session('loggedUser'));
        
       // return dd($author->id);
        $post_info = Post ::all()->where('user_id',$author->id)->where('is_approve',0);
        //$post_info = Post ::all()->where('user_id',$author->id);
       // $post_info = Category :: latest()->get()->where('user_id',$author->id);
        return view('author.post.unpublished_post_show',compact('post_info'));

      
    }    
    public function store_new_post(Request $request)
    {
       //dd($request->all());

       $request->validate([
        'title' => 'required|unique:posts|min:5|max:255',
        'excerpt' => 'required|unique:posts|min:5|max:255',
        'content' => 'required|min:5|unique:posts',
    ]);

    if ($request->hasFile('feature_image')){
        $image = $request->file('feature_image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('source/back/post'),$imageName);
    }else{
        $imageName = "postDefault.jpg";
    }

    $post = Post::create([                      // or we can also perform this using Model instance(object)->attribute/property/table_column_name = $request->(form html fiel name)
        'title'=>$request->title,
        'slug'=>strtolower(str_replace('','_',$request->title)),
        'excerpt'=>$request->excerpt,
        'content'=>$request->content,
        'status'=>$request->status,
        'category_id'=>$request->category_id,
        'user_id'=>$request->user_id,
        'postImage'=>$imageName,
    ]);
        $post->tags()->attach($request->tags);
       
       DB::table('category_post')->insert([
        'post_id' => $post->max('id'),
        'category_id' => $request->category_id
    ]);

    $id = 1;
    User::find($id)->notify(new NewPostNotification($post));
    $msg='Post Submitted Successfully';
    Toastr::success($msg, 'Success.!');
              
     return redirect()->back();
     
    }

    public function preview($id)
    {
        $post_info = Post :: find($id);
        $categories = category::all();
        $tags= Tag::all();
         
        return view('author.post.preview_post',compact('post_info','categories','tags'));
    }    
    public function update_post(Request $request,$id)
    {
        

        $request->validate([
            'title' => 'required|min:5|max:255',
            'excerpt' => 'required|min:5|max:255',
            'content' => 'required|min:5',
        ]);


        if ($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('source/back/post'),$imageName);
        }else{
            $imageName = "postDefault.jpg";
        }

        $post_info = Post :: find($id);

        $post_info->user_id=$request->user_id;
        $post_info->title=$request->title;
        $post_info->excerpt=$request->excerpt;
        $post_info->category_id=$request->category_id;
        $post_info->postImage=$imageName;
        $post_info->content=$request->content;
        
        $post_info->save();
        $msg='Post Updated Successfully';
        Toastr::success($msg, 'Success.!'); 
        $id = 1;
        User::find($id)->notify(new NewPostNotification($post_info));
        return redirect()->route('AuthorPostController.all_post_show');
         
       // return view('author.post.preview_post',compact('post_info'));
    }
}
