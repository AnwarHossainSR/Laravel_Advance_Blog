<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //fhrhgyueht
    //hdfhufdshfhjfhjd
    public function index()
    {
        $categories = Category::latest()->get();
        return view('superadmin.category.manage', compact('categories', $categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.category.add_form');
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
            'name' => 'required|unique:categories|max:20',
        ]);

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('source/back/category'), $imageName);
        } else {
            $imageName = "catDefault.jpg";
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = strtolower(str_replace('', '_', $request->name));
        $category->image = $imageName;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //$category = Category::find($id);
        return view('superadmin.category.edit_form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:20',
        ]);

        $cate = Category::find($request->id);

        if ($request->hasFile('feature_image')) {

            $existPhoto = '/source/back/category/' . $cate->image;
            $path = str_replace('\\', '/', public_path());
            if (file_exists($path . $existPhoto)) {
                \unlink($path . $existPhoto);
            }
            $image = $request->file('feature_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('source/back/category'), $imageName);

            $cate->name = $request->name;
            $category->slug = strtolower(str_replace('', '_', $request->name));
            $cate->image = $imageName;
            $cate->update();
        } else {
            $cate->name = $request->name;
            $category->slug = strtolower(str_replace('', '_', $request->name));
            $cate->update();
        }
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('success', 'Category deleted successfully');
    }

    public function hide($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return back()->with('success', 'Category hide successfully');
    }
    public function publish($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return back()->with('success', 'Category publish successfully');
    }
}
