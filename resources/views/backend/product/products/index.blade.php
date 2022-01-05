@extends('backend.layouts.app')
@section('content')

<div class="text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">All products</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('product.create') }}" class="btn btn-circle btn-info">
                <span>Add New Product</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <form class="" id="sort_products" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">All Product</h5>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Type & Press Enter">
                </div>
            </div>
        </div>
    </form>
    <div class="card-body">
        <table class="table mb-0" id="example1">
            <thead>
                <tr>
                    <th >#</th>
                    <th width="30%">Name</th>
                    <th >Category</th>
                    <th >Price</th>
                    <th >Quintity</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage()}}</td>
                        <td>{{ $product->name}}</td>
                        <td>
                            {{ $product->category->name }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->quintity }}
                        </td>
                        <td class="text-right">
                          <a class="btn btn-info btn-sm" href="{{route('product.edit',$product->id)}}">
                            <i class="fas fa-pencil-alt"> </i>
                          </a>
                          <a href="#" 
                            data-id={{$product->id}}
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
            {{ $products->appends(request()->input())->links() }}
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
              <form action="{{ route('admin.product-delete') }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input id="id" type="hidden" name="product_id">
                  <p class="mt-1">Are you sure to delete this?</p>                  
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')    
<script src="{{asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js' ) }}"></script>
<script>
    function update_active(el){
      // el.preventDefault()
      if(el.checked){
        var status = 1;
      }else{
        var status = 0;
      }
      $.post(
      '{{route("admin.product.active")}}',
        {_token:'{{ csrf_token() }}', id:el.value, status:status},
        function(data){
          if(data == 1){
            SRM.plugins.notification('success', 'Active category updated successfully');
          }
          else{
            SRM.plugins.notification('danger', 'Something went wrong');
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