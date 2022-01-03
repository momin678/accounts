@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center col-lg-8 mx-auto">
        <div class="col-md-6">
            <h1 class="h3">Create new category</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('category.index') }}" class="btn btn-primary">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Category Information</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Category Name" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Parent Category</label>
                        <div class="col-md-9">
                            <select class="select2 form-control" name="parent_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                <option value="0">Select Parent Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">Banner <small>(200x200)</small></label>
                        <div class="col-md-9">
                            <div class="custom-file">
                              <input type="file" name="banner" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">Icon <small>(32x32)</small></label>
                        <div class="col-md-9">
                            <div class="custom-file">
                              <input type="file" name="icon" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Meta Title</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Meta Description</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection