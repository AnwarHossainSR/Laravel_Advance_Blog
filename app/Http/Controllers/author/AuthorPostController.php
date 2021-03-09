<?php

namespace App\Http\Controllers\author;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AuthorPostController extends Controller
{
    public function add_post()
    {
       
       // $categories = Category::where('status',1)->get();
        $categories = Category::all();
        $tags= Tag::all();
        return view('author.post.add_post')->with('categories', $categories)
                                            ->with('tags',$tags);
    }  



    public function all_post_show()
    {
       
        $author = User::find(session('loggedUser'));
       // return dd($author->id);
        $post_info = Post ::orderBy('created_at','DESC')->get()->where('user_id',$author->id);
		//return dd($post_info);
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
        $post_info = Post ::all()->where('user_id',$author->id)->where('status','Unpublish');
        //$post_info = Post ::all()->where('user_id',$author->id);
       // $post_info = Category :: latest()->get()->where('user_id',$author->id);
        return view('author.post.unpublished_post_show',compact('post_info'));

      
    }    

    //------------Insert-----------


    public function store_new_post(Request $request)
    {
       //dd($request->all());

       $request->validate([
        'title' => 'required|unique:posts|min:5|max:255',
        'excerpt' => 'required|unique:posts|min:5|max:255',
        'content' => 'required|min:5|unique:posts',
    ]);

    $img=  $request->file('feature_image');

    if(isset($img))        // if image data inserted
    {
        $currentDate= Carbon ::now()->toDateString();

        $imgName='author_post'.'_'.$currentDate.'_'.uniqid().'.'.$img->getClientOriginalExtension();


        //Checking directory existance
        if(!Storage::disk('public')->exists('post_img'))
        {
            Storage::disk('public')->makeDirectory('post_img');
        }
           
        $resized_img= Image::make($img)->resize(1640,856)->stream();//->save()

         Storage::disk('public')->put('post_img/'.$imgName,$resized_img);

    }

    else
    {
        $imgName= 'default.jpg';          // 'default.jpg';
    }


    $post = Post::create([                      // or we can also perform this using Model instance(object)->attribute/property/table_column_name = $request->(form html fiel name)
        'title'=>$request->title,
        'slug'=>strtolower(str_replace('','_',$request->title)),
        'excerpt'=>$request->excerpt,
        'content'=>$request->content,
        'status'=>$request->status,
        'category_id'=>$request->category_id,
        'user_id'=>$request->user_id,
        'postImage'=>$imgName,
    ]);
       
        $post->tags()->attach($request->tags);
        //$post->categories()->attach($request->categories);
       
        DB::table('category_post')->insert([
         'post_id' => $post->max('id'),
         'category_id' => $request->category_id
     ]);

    $msg='New Post added Successfully';
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
   
  
    //------------Update-----------

    
   public function update_post(Request $request,$id)
    {
        

        $request->validate([
            'title' => 'required|min:5|max:255',
            'excerpt' => 'required|min:5|max:255',
            'content' => 'required|min:5',
        ]);
       
        $post_info = Post :: find($id);

        $img=  $request->file('feature_image');

        if(isset($img))        // if image data inserted
        {
            $currentDate= Carbon ::now()->toDateString();

            $imgName='author_post'.'_'.$currentDate.'_'.uniqid().'.'.$img->getClientOriginalExtension();


            //Checking directory existance
            if(!Storage::disk('public')->exists('post_img'))
            {
                Storage::disk('public')->makeDirectory('post_img');
            }
            //Checking Duplicate filename existance

            if(Storage::disk('public')->exists('post_img/'.$post_info->postImage))
            {
                Storage::disk('public')->delete('post_img/'.$post_info->postImage);
            }

               
            $resized_img= Image::make($img)->resize(128,128)->stream();//->save()

             Storage::disk('public')->put('post_img/'.$imgName,$resized_img);

        }

        else
        {
            $imgName= $post_info->postImage;          // 'default.jpg';
        }

        $post_info->user_id=$request->user_id;
        $post_info->title=$request->title;
        $post_info->excerpt=$request->excerpt;
        $post_info->category_id=$request->category_id;
        $post_info->postImage=$imgName;
        $post_info->content=$request->content;
        
        $post_info->save();
        $msg='Post Updated Successfully';
        Toastr::success($msg, 'Success.!'); 

        return redirect()->route('AuthorPostController.all_post_show');
         
       // return view('author.post.preview_post',compact('post_info'));
    }



    public function destroy(Post $id)
    {
      
        //dd($id);
       // return $id;

       if(Storage::disk('public')->exists('post_img/'.$id->postImage))
       {
           Storage::disk('public')->delete('post_img/'.$id->postImage);
       }

       $id->delete();
       //$id->tags()->detach();
      // $id->categories()->detach();

       $msg='Successfully Deleted';
       Toastr::success($msg, 'Success.!'); 
       return redirect()->back();


    }
}
