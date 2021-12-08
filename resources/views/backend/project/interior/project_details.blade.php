@extends('backend.layouts.app')
@section('content')
    
<section id="tabs" class="project-tab">
    <div class="container">
        <div class="col-md-12  tab-content">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Project Information</a>
                    <a class="nav-item nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                </div>
            </nav>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h4 class="text-center pt-2"><strong class="pr-2">Project Name: </strong><span class="text-success ">{{ $project_info->name }}</span></h4>
                        <table class="table table-sm table-bordered" cellspacing="0">
                            @php
                                $total_payment = App\Models\Project::totalPayment($project_info->id);
                                $total_cost = App\Models\Project::totalCost($project_info->id);
                                $adjust_values = App\Models\Project::adjust_values($project_info->id);
                            @endphp
                            <tbody>
                                <tr>
                                    <td><b>Project Values:</b> </td>
                                    <td>TK. {{ $project_info->budget +$adjust_values}}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Adjust Budget: </td>
                                    <td>TK. {{ $adjust_values }}</td>
                                </tr> --}}
                                <tr>
                                    <td><b>Received Peyment:</b> </td>
                                    <td>TK. {{ $total_payment }}</td>
                                </tr>
                                <tr>
                                    <td><b>Project Expenses:</b> </td>
                                    <td>TK. {{$total_cost}}</td>
                                </tr>
                                <tr>
                                    <td><b>Project Due:</b> </td>
                                    <td>TK. {{($project_info->budget+$adjust_values) - $total_payment}}</td>
                                </tr>
                                <tr>
                                    <td><b>Project Profite:</b> </td>
                                    <td>TK. {{ ($project_info->budget+$adjust_values) - $total_cost }}</td>
                                </tr>
                                <tr>
                                    <td><b>Project Location:</b> </td>
                                    <td>{{ $project_info->location }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Project Institution: </td>
                                    <td>{{ $project_info->institution }}</td>
                                </tr> --}}
                                @if ($project_info->start)
                                <tr>
                                    <td><b>Project Start:</b> </td>
                                    <td>{{ $project_info->start }}</td>
                                </tr>  
                                @endif
                                @if ($project_info->expiration)
                                <tr>
                                    <td><b>Project Expiration:</b> </td>
                                    <td>{{ $project_info->expiration }}</td>
                                </tr>
                                @endif
                                @if ($project_info->description)
                                <tr>
                                    <td><b>Project Description:</b> </td>
                                    <td>{{ $project_info->description }}</td>
                                </tr>  
                                @endif
                                @if ($project_info->document)
                                <tr>
                                    <td><b>Project Document:</b> </td>
                                    <td>
                                        @foreach (json_decode($project_info->document) as $file)
                                            @if ($file)
                                                <img src="{{ asset('assets/document') }}/{{ $file }}" alt="" width="100">
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="text-center text-success pt-2">Project Cost</p>
                        <table class="table  table-sm table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order Number</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_cost as $cost)
                                    <tr>
                                        <td><a href="{{ route('project.cost.show', $cost->id)}}">{{ $cost->date }}</a></td>
                                        <td>{{ $cost->invoice_number }}</td>
                                        <td>
                                            @php
                                                $amount = 0;
                                                foreach(json_decode($cost->amount) as $value){
                                                    $amount += $value;
                                                }
                                            @endphp
                                            TK. {{ $amount }}
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <p class="text-center text-success pt-2">Get Payment</p>
                        <table class="table table-sm table-bordered" cellspacing="0">
                            @php
                                $total_payment = App\Models\Project::totalPayment($project_info->id);
                                $total_cost = App\Models\Project::totalCost($project_info->id);
                            @endphp
                            <thead>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Amount</th>
                            </thead>
                            <tbody>
                                @foreach ($getPayment as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->method }}</td>
                                        <td>TK. {{ $payment->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="text-center text-success pt-2">Make Payment</p>
                        <table class="table  table-sm table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($makePayment as $payment)
                                    <tr>
                                        @php
                                            $supplier = \App\Models\Supplier::where('id', $payment->supplier_id)->select('name')->first();
                                        @endphp
                                        <td><a href="{{ route('supplier.index') }}">{{$supplier->name}}</a></td>
                                        <td>{{ $payment->date }}</td>
                                        <td>TK.{{ $payment->amount }}</td>
                                        <td>{{ $payment->method }}</td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection