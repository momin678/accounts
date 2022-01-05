<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $sort_search = null;
        $products = Product::orderBy('id', 'asc');
        if($request->has('search')){
            $sort_search = $request->search;
            $products = $products->where('name', 'like', '%'.$sort_search.'%');
        }
        $products = $products->paginate(15);
        return view('backend.product.products.index', compact('brands', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.product.products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->quintity = $request->quintity;
        $product->specification = $request->specification;
        $photos = $request->file('photos');
        if($photos !== null){
            $photosName = rand(100, 9999).time().'.'. $photos->extension();
            $filePath = public_path('/images/product');
            $img = Image::make($photos->path());
            $img->resize(300, 300, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$photosName);
            $images = $photosName;
        }
        $product->photos = $images;
        $product->slug = Str::slug($request->name, '-').'-'.Str::random(5);
        $product->save();
        flash('Product has been inserted successfully')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.product.products.edit', compact('brands', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product_info = Product::find($product->id);
        $product_info->name = $request->name;
        $product_info->category_id = $request->category_id;
        $product_info->brand_id = $request->brand_id;
        $product_info->price = $request->price;
        $product_info->quintity = $request->quintity;
        $product_info->specification = $request->specification;
        if($request->file('photos')){
            $photo = $request->file('photos');
            if($photo !== null){
                $photosName = rand(100, 9999).time().'.'. $photo->extension();
                $filePath = public_path('/images/product');
                $img = Image::make($photo->path());
                $img->resize(300, 300, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$photosName);
                $images = $photosName;
            }
            if($product->photos){
                $image = public_path('images/product').'/'.$product->photos;
                if(file_exists($image)){
                   unlink($image); 
                }
            }
            $product_info->photos = $images;
        }
        $product_info->save();
        flash('Product has been update successfully')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        dd($product);
    }
    public function product_delete(Request $request){
        $product_info = Product::find($request->product_id);
        if($product_info->photos){
            $image = public_path('images/product')."/".$product_info->photos;
            if(file_exists($image)){
                unlink($image);
            }
        }
        $product_info->delete();
        flash('Product has been delete successfully')->success();
        return back();
    }
}
