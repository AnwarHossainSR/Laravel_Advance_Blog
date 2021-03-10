<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
use Validator;
use Session;

class AdminTagController extends Controller
{
    public function index()
    {
        $tag = Tag::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.tag.index')->with('tags', $tag);
    }
    public function create()
    {
        return view('admin.tag.create');
    }
    public function createPost(Request $req)
    {
        $validation = validator::make($req->all(), [
            'name' => 'required|min:3|max:15|unique:tags,name',
            'slug' => 'required|min:5',
        ]);
        if ($validation->fails()) {
            return redirect()->route('admin.tag.create')->with('errors', $validation->errors())->withInput();
        }
        $tag = new Tag();
        $tag->name = $req->name;
        $tag->slug = Str::slug($req->name, '-');
        $tag->save();
        Session::flash('success', 'Tag created successfully');
        //return redirect()->route('admin.category.all');
        return redirect()->back();
    }
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit')->with('tags', $tag);
    }
    public function editPost($id, Request $req)
    {
        $validation = validator::make($req->all(), [
            'name' => 'required|min:3|max:15',
            'slug' => 'required|min:3',
        ]);
        if ($validation->fails()) {
            return Back()->with('errors', $validation->errors());
        }
        $tag = Tag::find($id);
        $tag->name = $req->name;
        $tag->slug = Str::slug($req->name, '-');
        $tag->save();
        Session::flash('success', 'Tag updated successfully');
        return redirect()->back();
        //return view('admin.category.edit')->with('categories', $category);
    }
    public function delete($id)
    {
        Tag::destroy($id);
        Session::flash('success', 'Tag deleted successfully');
        return redirect()->route('admin.tags.all');
    }
    public function details($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.details')->with('tags', $tag);
    }
}
