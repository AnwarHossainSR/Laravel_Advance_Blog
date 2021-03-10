<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminCategoryController extends Controller
{
    public function index1()
    {
        $category = Category::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.category.index')->with('categories', $category);
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function createPost(Request $req)
    {
        $validation = validator::make($req->all(), [
            'name' => 'required|min:3|max:15|unique:categories,name',
            'slug' => 'required|min:5',
        ]);
        if ($validation->fails()) {
            return redirect()->route('admin.category.create')->with('errors', $validation->errors())->withInput();
        }
        $files = $req->file('file');
        $files->move('upload', $files->getClientOriginalName());
        $category = new Category();
        $category->name = $req->name;
        $category->slug = $req->slug;
        $category->image = $files->getClientOriginalName();
        $category->save();
        Session::flash('success', 'category created successfully');
        return redirect()->back();
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')->with('categories', $category);
    }
    public function editPost($id, Request $req)
    {
        $validation = validator::make($req->all(), [
            'name' => 'required|min:3|max:15',
            'slug' => 'required|min:5',
        ]);
        if ($validation->fails()) {
            return Back()->with('errors', $validation->errors());
        }
        $cate = Category::find($req->id);

        if ($req->hasFile('file')) {

            $existPhoto = '/upload' . $cate->image;
            $path = str_replace('\\', '/', public_path());
            if (file_exists($path . $existPhoto)) {
                \unlink($path . $existPhoto);
            }
            $image = $req->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/upload'), $imageName);

            $cate->name = $req->name;
            $cate->slug = $req->slug;
            $cate->image = $imageName;
            $cate->save();
            Session::flash('success', 'category updated successfully');
        } else {
            $cate->name = $req->name;
            $cate->slug = $req->slug;
            $cate->save();
            Session::flash('success', 'category updated successfully');
        }
        return redirect()->back();
        //return view('admin.category.edit')->with('categories', $category);
    }
    public function delete($id)
    {
        Category::destroy($id);
        Session::flash('success', 'category deleted successfully');
        return redirect()->route('admin.category.all');
    }
    public function details($id)
    {
        $category = Category::find($id);
        return view('admin.category.details')->with('categories', $category);
    }
}
