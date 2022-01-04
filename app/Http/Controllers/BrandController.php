<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $sort_search = null;
     $brands = Brand::orderBy('id', 'asc');
     if($request->has('search')){
         $sort_search = $request->search;
         $brands = $brands->where('name', 'like', '%'.$sort_search.'%');
     }
     $brands = $brands->paginate(15);
     return view('backend.product.brands.index', compact('brands', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        if($request->hasFile('icon')){
            $icon = $request->icon;
            $name = rand(1000, 9999).time().'.'.$icon->extension();
            $filePath = public_path('/images/brand');
            $img = Image::make($icon->path());
            $img->resize(32, 32, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $brand->icon = $name;
        }
        $brand->save();
        flash('Brand has been inserted successfully')->success();
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.product.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand = Brand::find($brand->id);
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if($request->hasFile('icon')){
            $icon = $request->icon;
            $name = rand(1000, 9999).time().'.'.$icon->extension();
            $filePath = public_path('/images/brand');
            $img = Image::make($icon->path());
            $img->resize(32, 32, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
            $brand->icon = $name;
        }
        $brand->save();
        flash('Brand has been Update successfully')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
    public function brand_delete(Request $request){
        $brand_info = Brand::find($request->id);
        if($brand_info->icon){
            $icon_image = public_path('images/brand')."/".$brand_info->icon;
            if(file_exists($icon_image)){
                unlink($icon_image);
            }
        }
        Brand::delete_brand($brand_info->id);
        flash('Brand has been delete successfully')->success();
        return back();
    }
    public function updateActive(Request $request){
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status;
        if($brand->save()){
            return 1;
        }
        return 0;
    }
}
