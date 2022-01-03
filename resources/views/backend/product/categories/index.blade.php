@extends('backend.layouts.app')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    </style>
@section('content')
<div class="text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All categories</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('category.create') }}" class="btn btn-primary">
                <span>Add New category</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
  <div class="card-header d-block d-md-flex">
      <h5 class="h6 mr-4">Category search</h5>
      <form class="" id="sort_categories" action="" method="GET">
          <div class="box-inline pad-rgt pull-left">
              <div class="" style="min-width: 400px;">
                  <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name & Press Enter Button">
              </div>
          </div>
      </form>
  </div>
  <div class="card-body">
      <table class="table mb-0">
          <thead>
              <tr>
                  <th data-breakpoints="lg">#</th>
                  <th>Name</th>
                  <th data-breakpoints="lg">Parent Category</th>
                  <th data-breakpoints="lg">Icon</th>
                  <th data-breakpoints="lg">Active</th>
                  <th width="10%" class="text-right">Options</th>
              </tr>
          </thead>
          <tbody>
              @foreach($categories as $key => $category)
                  <tr>
                      <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                      <td>{{ $category->name}}</td>
                      <td>
                          @php
                              $parent = \App\Models\Category::where('id', $category->parent_id)->first();
                          @endphp
                          @if ($parent != null)
                              {{ $parent->name }}
                          @else
                              ------
                          @endif
                      </td>
                      <td>
                          @if ($category->icon)
                          <img alt="Icon" class="table-avatar" src="{{asset('images/category')}}/{{$category->icon}}" width="30">
                          @else
                              ------
                          @endif
                      </td>
                      <td>
                          {{-- <label class="mb-0 ">
                            <input type="checkbox" value="{{$category->id}}" onchange="update_active(this)" name="my-checkbox" {{$category->status == 1 ? 'checked' : 'unchecked' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                          </label> --}}
                          <label class="switch">
                            <input type="checkbox" value="{{$category->id}}" onchange="update_active(this)" name="my-checkbox" {{$category->status == 1 ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>                          
                      </td>
                      <td class="text-right">
                        <a class="btn btn-info btn-sm" href="{{route('category.edit',$category->id)}}">
                          <i class="fas fa-pencil-alt"> </i>
                        </a>
                        <a href="#" 
                          data-id={{$category->id}}
                          data-toggle="modal" 
                          data-target="#deleteModal"
                          class="btn btn-danger btn-sm delete">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <div class="">
          {{ $categories->appends(request()->input())->links() }}
      </div>
  </div>
</div>

<div  id="deleteModal" class="modal fade">
  <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title h6">Delete Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body text-center">
              <form action="{{ route('admin.category-delete') }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input id="id" type="hidden" name="category_id" value="">
                  <p class="mt-1">Are you sure to delete this?</p>                  
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </div>
      </div>
  </div>
</div>
      <!-- End Delete Modal --> 
@endsection
@section('js')
<script src="{{asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js' ) }}"></script>
<script>
  function update_active(el){
    if(el.checked){
      var status = 1;
    }else{
      var status = 0;
    }
    $.post(
    '{{route("admin.category.active")}}',
      {_token:'{{ csrf_token() }}', id:el.value, status:status},
      function(data){
        if(data == 1){
          ADM.plugins.notification('success', 'Active category updated successfully');
        }
        else{
          ADM.plugins.notification('danger', 'Something went wrong');
        }
      });
  }
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $(document).on('click','.delete',function(){
         let id = $(this).attr('data-id');
         $('#id').val(id);
    });
</script>
@endsection