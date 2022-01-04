@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center col-lg-8 mx-auto">
        <div class="col-md-6">
            <h1 class="h3">Edit Brand</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('brand.index') }}" class="btn btn-primary">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">Name <i class="las la-language text-danger" title="Translatable"></i></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Name" id="name" name="name" value="{{ $brand->name }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="signinSrEmail">Icon <small>(32x32)</small></label>
                    <div class="col-md-9">
                        <div class="custom-file">
                          <input type="file" name="icon" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @if ($brand->icon)
                            <img src="{{asset('images/brand')}}/{{$brand->icon}}" width="50px" class="m-1">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">Meta Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $brand->meta_title }}" placeholder="Meta Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">Meta Description</label>
                    <div class="col-sm-9">
                        <textarea name="meta_description" rows="8" class="form-control">{{ $brand->meta_description }}</textarea>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
