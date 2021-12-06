@extends('backend.layouts.app')
@section('css')
@endsection
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">Check Return</h1>
        </div>
    </div>
</div>

@include('errors.error_massege')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Check Order</h5>
			</div>
			<div class="card-body">
                <form action="{{ route('return-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$order_info->id}}" name="order_id">
                    <input type="hidden" name="project_id" value="{{ $order_info->project_id }}">
                    <input type="hidden" name="supplier_id" value="{{ $order_info->supplier_id }}">
                    <input type="hidden" name="invoice_number" value="{{ $order_info->invoice_number }}">
                    @foreach (json_decode($cost_info->name) as $key => $value)
                        @php
                            $product_info = App\Models\SupplyGoods::find($value); 
                            $quantity = json_decode($cost_info->quantity);
                            $amount = json_decode($cost_info->amount);
                        @endphp
                        <div class="row" id="inputFormRow">
                            <div class="form-group col-md-6">
                                <input class="form-control" type="text" name="name[]" data-type="name" value="{{$product_info->name}}" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" name="quantity[]" class="form-control" required value="{{$quantity[$key]}}">
                            </div>
                            <div class="form-group col-md-3 col-10">
                                <input type="number" name="amount[]" class="form-control" required placeholder="total price" value="{{ $amount[$key] }}">
                            </div>
                            <div class="col-md-1 col-2">
                                <button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endsection