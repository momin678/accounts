<?php

namespace App\Http\Controllers;

use App\Models\MakeOrder;
use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Project;
use App\Models\SupplyGoods;
use App\Models\Supplier;

class MakeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_project = Project::all();
        $all_supplier = Supplier::all();
        return view('backend.project.interior.make_order', compact('all_project', 'all_supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cost = new Cost;
        $cost->project_id = $request->project_id;
        $cost->supplier_id = $request->supplier_id;
        $cost->date = $request->date;
        $names = [];
        $description = $request->description;
        if($request->name){
          foreach($request->name as $key => $value){
              $goods= SupplyGoods::where('name', $value)->first();
              if($goods == null){
                  $supply_goods = new SupplyGoods;
                  $supply_goods->name= $value;
                  $supply_goods->description= $request->description[$key];
                  $supply_goods->save();
                  $names[] = $supply_goods->id;
              }else{
                $names[] = $goods->id;
              }
            }
        }
        // dd($names);
        $cost->name = json_encode($names);
        $quantities = [];
        if($request->quantity){
          foreach($request->quantity as $quantity){
                $quantities[] = $quantity;
            }
        }
        $cost->quantity = json_encode($quantities);
        $amounts = [];
        $total_amount = 0;
        if($request->amount){
          foreach($request->amount as $amount){
                $amounts[] = $amount;
                $total_amount +=$amount;
            }
        }
        if($request->supplier_id){
            $supplier_id = Supplier::find($request->supplier_id);
                $supplier_id->total_amount = $supplier_id->total_amount+$total_amount;
                $supplier_id->save();
        }
        $cost->amount = json_encode($amounts);
        $document = [];
        if($request->hasfile('document')){
          foreach($request->file('document') as $file){
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('assets/document'), $name);
            $document[] = $name;
            }
        }
        $cost->document = json_encode($document);
        $cost->description = $request->description;
        $cost->save();
        return back()->with('success', 'Cost create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function show(MakeOrder $makeOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(MakeOrder $makeOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MakeOrder $makeOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MakeOrder $makeOrder)
    {
        //
    }
}
