@extends('backend.layouts.app')
@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center mx-auto">
        <h1 class="h3">Create new product</h1>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>
<div class="">
    <form class="form form-horizontal mar-top" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        <div class="row gutters-5">
            <div class="col-lg-8">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" placeholder="Product Name" required>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-md-3 col-from-label">Category <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="select2 form-control multiple_select" data-live-search="true"
                                data-selected-text-format="count" name="category_id" required>
                                    <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-md-3 col-from-label">Brand </label>
                            <div class="col-md-8">
                                <select class="select2 form-control multiple_select" data-live-search="true"
                                data-selected-text-format="count" name="brand_id">
                                    <option value="">Select brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Product Price <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="price" placeholder="Product price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Product quintity </label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="quintity" placeholder="Product quintity" required value="100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">Gallery Images <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="photos" required>
                                <small class="text-muted">These images are visible in product details page gallery. Use 600x600 sizes images.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Product Specification</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">                            
                            <textarea class="textEditor" name="specification"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button type="submit" class="btn btn-success">Save & Publish</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
<script>
    tinymce.init({
      selector: '.textEditor',
      height: 200,
      plugins: 'advlist lists link code preview searchreplace wordcount media table emoticons image imagetools',
      toolbar: 'undo redo bold italic styleselect underline alignleft aligncenter alignright bullist numlist image table',
    });
</script>
@endsection
