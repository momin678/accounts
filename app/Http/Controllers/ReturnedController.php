<?php

namespace App\Http\Controllers;

use App\Models\Returned;
use Illuminate\Http\Request;
use App\Models\MakeOrder;
use App\Models\Cost;
use App\Models\SupplyGoods;
class ReturnedController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Returned  $returned
     * @return \Illuminate\Http\Response
     */
    public function show(Returned $returned)
    {
        // dd($returned);
        return view('backend.project.interior.return_details', compact('returned'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Returned  $returned
     * @return \Illuminate\Http\Response
     */
    public function edit(Returned $returned)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Returned  $returned
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Returned $returned)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Returned  $returned
     * @return \Illuminate\Http\Response
     */
    public function destroy(Returned $returned)
    {
        //
    }
    public function return_check($id){
        $order_info = MakeOrder::find($id);
        $cost_info = Cost::where('invoice_number', $order_info->invoice_number)->first();
        // dd($cost_info);
        return view('backend/project/interior/return_check', compact('order_info', 'cost_info'));
    }
    public function return_store(Request $request){
        $order = new Returned;
        $order->project_id = $request->project_id;
        $order->supplier_id = $request->supplier_id;
        $order->order_id = $request->order_id;
        $order->invoice_number = $request->invoice_number;
        $order->date = date('Y-m-d');
        $names = [];
        if($request->name){
            foreach($request->name as $key => $value){
                $goods= SupplyGoods::where('name', $value)->first();
                $names[] = $goods->id;
            }
        }
        $order->name = json_encode($names);
        $quantities = [];
        if($request->quantity){
          foreach($request->quantity as $quantity){
            $quantities[] = $quantity;
            }
        }
        $order->quantity = json_encode($quantities);
        $amounts = [];
        if($request->amount){
          foreach($request->amount as $amount){
            $amounts[] = $amount;
            }
        }
        $order->amount = json_encode($amounts);
        $order->save();
        return back()->with('success', 'Return add successful');
    }
}
