@extends('backend.layouts.app')
@section('css')
@endsection
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">Goods Orders</h1>
        </div>
    </div>
</div>

@include('errors.error_massege')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Edit Order</h5>
			</div>
			<div class="card-body">
                <form action="{{ route('make-order.update', $makeOrder->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                        <select class="form-control multiple_select" name="project_id" required>
                            <option value=""></option>
                            @foreach($all_project as $project)
                                <option value="{{$project->id}}" @if ($project->id == $makeOrder->project_id) selected @endif>{{$project->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <select class="form-control multiple_select" name="supplier_id" required>
                            <option value=""></option>
                            @foreach($all_supplier as $supplier)
                                <option value="{{$supplier->id}}" @if ($supplier->id == $makeOrder->supplier_id) selected @endif>{{$supplier->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    @foreach (json_decode($makeOrder->name) as $key => $value)
                        @php
                            $product_info = App\Models\SupplyGoods::find($value); 
                            $quantity = json_decode($makeOrder->quantity);
                        @endphp
                        <div class="row" id="inputFormRow">
                            <div class="form-group col-md-8">
                                <input class="form-control autocomplete_field" type="text" name="name[]" data-type="name" id="name_00".$key value="{{$product_info->name}}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="quantity[]" class="form-control" required value="{{$quantity[$key]}}">
                            </div>
                            <div class="form-group col-md-11 col-10">
                                <textarea class="form-control autocomplete_field" rows="1" data-type="description" name="description[]" id="description_00".$key>{{$product_info->description}}</textarea>
                            </div>
                            <div class="col-md-1 col-2">
                                <button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="form-group col-md-8">
                            <input class="form-control autocomplete_field" type="text" name="name[]" data-type="name" id="name_1" placeholder="Product name" >
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="quantity[]" class="form-control" placeholder="product quantity">
                        </div>
                        <div class="form-group col-md-11 col-10">
                            <textarea class="form-control autocomplete_field" rows="1" data-type="description" name="description[]" id="description_1" placeholder="product description"></textarea>
                        </div>
                        <div class="form-group col-md-1 col-2">
                            <button id="addRow" type="button" class="btn btn-info"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div id="newRow"></div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var id = 2;
    $("#addRow").click(function () {
        var addNew = '';
        addNew += '<div class="row" id="inputFormRow">'
        addNew +=   '<div class="form-group col-md-8">'
        addNew +=       '<input type="text" name="name[]" data-type="name" class="form-control autocomplete_field" id="name_'+id+'" placeholder="Product name">'
        addNew +=   '</div>'
        addNew +=    '<div class="form-group col-md-4">'
        addNew +=        '<input type="text" name="quantity[]" class="form-control" placeholder="product quantity">'
        addNew +=    '</div>'
        addNew +=    '<div class="form-group col-md-11 col-10">'
        addNew +=        '<textarea class="form-control autocomplete_field" data-type="description" rows="1" name="description[]" id="description_'+id+'" placeholder="product description"></textarea>'
        addNew +=    '</div>'
        addNew +=    '<div class="col-md-1 col-2">'
        addNew +=        '<button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>'
        addNew +=    '</div>'
        addNew += '</div>'
        $('#newRow').append(addNew);
        id++;
    });
    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
<script type="text/javascript">
    var route = "{{ route('project.supply-goods-search') }}";
//autocomplete script
$(document).on('focus','.autocomplete_field',function(){
  type = $(this).data('type');  
  if(type =='name' )autoType='name';
  if(type =='description' )autoType='description'; 
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('project.supply-goods-search') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                    response(array)
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#name_'+elementId).val(data.name);
           $('#description_'+elementId).val(data.description);
       }
   });
   
});
</script>
@endsection