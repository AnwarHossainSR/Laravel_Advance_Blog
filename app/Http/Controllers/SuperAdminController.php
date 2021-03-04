<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('superadmin.profile.manage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'title' => 'required|unique:Users|min:5|max:255',
            'excerpt' => 'required|unique:Users|min:5|max:255',
            'content' => 'required|min:10|unique:Users',
        ]);

        if ($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('source/back/User'),$imageName);
        }else{
            $imageName = "UserDefault.jpg";
        }

        $User = User::create([
            'title'=>$request->title,
            'slug'=>strtolower(str_replace('','_',$request->title)),
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id,
            'UserImage'=>$imageName,
        ]);

        return redirect()->route('User.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $u)
    {
        
         $request->validate([
            'name' => 'required|unique:users|min:3|max:20|',
            'email' => 'required:unique:users|min:12|max:50'
        ]);

        $user = User::find($request->user_id);

        if ($request->hasFile('feature_image')){

            $existPhoto = '/source/back/profile/'.$user->profileImage;
            $path = str_replace('\\','/',public_path());
            if (file_exists($path.$existPhoto)) {
                \unlink($path.$existPhoto);
            }
            $image = $request->file('feature_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('source/back/profile'),$imageName);

            $u->name = $request->name;
            $u->email = $request->email;
            $u->profileImage = $imageName;
            $u->update();

        }else{
            $u->name = $request->name;
            $u->email = $request->email;
            $u->profileImage = $user->profileImage;
            $u->update();
        }

        return back()->with('success','Profile updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
       
    }
}



