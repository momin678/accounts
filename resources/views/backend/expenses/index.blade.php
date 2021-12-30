@extends('backend.layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@section('content')
@section('content')
<div class="text-left mb-3 m-4">
    <div class="row align-items-center">
        <div class="col-auto">
          <h1 class="h3">Office Expenses</h1>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">Expenses</h5>
        </div>
        <div class="card-body">
    <form action="{{ route('office-expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-4 col-12">
                <label for="name">Month</label>
                <select name="month" class="form-control">
                    @php
                        use Carbon\CarbonPeriod;
                    @endphp
                    @foreach(CarbonPeriod::create(now()->startOfMonth(), '1 month', now()->addMonths(11)->startOfMonth()) as $date)
                        <option value="{{ $date->format('F') }}">
                            {{ $date->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="date">Date</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control"/>                
            </div>
            <div class="form-group  col-md-4 col-12">
                <label for="name">Payment Method</label>
                <select class="form-control" name="method" required>
                    <option value="Cahs-on">Cahs-on</option>
                    <option value="Check">Check</option>
                    <option value="bKash">bKash</option>
                    <option value="Nagad">Nagad</option>
                    <option value="Roket">Roket</option>
                </select>
            </div>
        </div>
        <div >
            <div class="form-group">
                <input class="form-control autocomplete_field" type="text" name="name[]" data-type="name" id="name_1" placeholder="Product name" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <input type="text" name="quantity[]" class="form-control" required placeholder="product quantity">
            </div>
            <div class="form-group col-md-5">
                <input type="text" name="amount[]" class="form-control" required placeholder="product price">
            </div>
            <div class="form-group col-md-1 col-2">
                <button id="addRow" type="button" class="btn btn-info"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div id="newRow"></div>
        <div class="form-group mb-3 text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
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
        addNew +=   '<div class="form-group col-md-12">'
        addNew +=       '<input type="text" name="name[]" data-type="name" class="form-control autocomplete_field" id="name_'+id+'" placeholder="Product name" required>'
        addNew +=   '</div>'
        addNew +=    '<div class="form-group col-md-5">'
        addNew +=        '<input type="text" name="quantity[]" class="form-control" required placeholder="product quantity">'
        addNew +=    '</div>'
        addNew +=    '<div class="form-group col-md-5">'
        addNew +=        '<input type="text" name="amount[]" class="form-control" required placeholder="product price" >'
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
            }
        });
    });
</script>
@endsection