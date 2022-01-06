<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Benefit\CategoryBenefit;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = Category::orderBy('id', 'asc');
        if($request->search){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        $categories = $categories->paginate(15);
        return view('backend.product.categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        if($request->hasFile('banner')){
            $banner = $request->banner;
            $name = rand(1000, 9999).time().'.'.$banner->extension();
            $filePath = public_path('/images/category');
            $img = Image::make($banner->path());
            $img->resize(200, 200, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $category->banner = $name;
        }
        if($request->hasFile('icon')){
            $icon = $request->icon;
            $name = rand(1000, 9999).time().'.'.$icon->extension();
            $filePath = public_path('/images/category');
            $img = Image::make($icon->path());
            $img->resize(32, 32, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $category->icon = $name;
        }
        if($request->parent_id != "0"){
            $category->parent_id = $request->parent_id;
            $category_id = Category::find($request->parent_id);
            $category->level = $category_id->level +1;
        }
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        $category->save();
        flash('Category has been inserted successfully')->success();
        return back();
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
        $categories = Category::all();
        $category_info = Category::find($category->id);
        return view('backend.product.categories.edit', compact('categories', 'category_info'));
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
        $category_info = Category::find($category->id);
        $category_info->name = $request->name;
        if($request->hasFile('banner')){
            $banner = $request->banner;
            $name = rand(1000,9999).time().'.'.$banner->extension();
            $filePath = public_path('/images/category');
            $img = Image::make($banner->path());
            $img->resize(200, 200, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $category_info->banner = $name;
            if($category->banner){
                $image = public_path('images/category').'/'.$category->banner;
                if(file_exists($image)){
                   unlink($image); 
                }
            }
        }
        if($request->hasFile('icon')){
            $icon = $request->icon;
            $name = rand(1000,9999).time().'.'.$icon->extension();
            $filePath = public_path('/images/category');
            $img = Image::make($icon->path());
            $img->resize(32, 32, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $category_info->icon = $name;
            if($category->icon){
                $image = public_path('images/category').'/'.$category->icon;
                if(file_exists($image)){
                    unlink($image);
                }
            }
        }
        if($request->parent_id != "0"){
            $category_info->parent_id = $request->parent_id;
            $category_id = Category::find($request->parent_id);
            $category_info->level = $category_id->level +1;
        }
        $category_info->meta_title = $request->meta_title;
        $category_info->meta_description = $request->meta_description;
        $category_info->save();
        flash('Category has been update successfully')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        //
    }
    public function cat_delete(Request $request){
        $category_info = Category::find($request->category_id);
        // $products = Product::where('category_id', $category_info->id)->get();
        // foreach ($products as $product) {
        //     $product->category_id = null;
        //     $product->save();
        // }
        if($category_info->banner){
            $banner_image = public_path('images/category').'/'.$category_info->banner;
            if(file_exists($banner_image)){
                unlink($banner_image);
            }
        }
        if($category_info->icon){
            $icon_image = public_path('images/category')."/".$category_info->icon;
            if(file_exists($icon_image)){
                unlink($icon_image);
            }
        }
        CategoryBenefit::delete_category($category_info->id);
        flash('Category has been delete successfully')->success();
        return redirect()->route('category.index');
    }
    public function updateActive(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = $request->status;
        if($category->save()){
            return 1;
        }
        return 0;
    }
}
