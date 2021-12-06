<?php

namespace App\Http\Controllers;

use App\Models\MakeOrder;
use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Project;
use App\Models\SupplyGoods;
use App\Models\Supplier;
use Illuminate\Support\Facades\Redirect;
use PDF;
class MakeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_order = MakeOrder::orderBy('id', 'DESC')->get();
        $all_project = Project::all();
        $all_supplier = Supplier::all();
        return view('backend.project.interior.order_list', compact('all_order', 'all_project', 'all_supplier'));
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
        $all_project = Project::all();
        $all_supplier = Supplier::all();
        $order = new MakeOrder;
        $order->project_id = $request->project_id;
        $order->supplier_id = $request->supplier_id;
        $order->date = date('Y-m-d');
        $order->invoice_number = rand(100, 999).time();
        $names = [];
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
        $order->name = json_encode($names);
        $quantities = [];
        if($request->quantity){
          foreach($request->quantity as $quantity){
            $quantities[] = $quantity;
            }
        }
        $order->quantity = json_encode($quantities);
        $document = [];
        if($request->hasfile('document')){
          foreach($request->file('document') as $file){
            $name = time().rand(100,999).'.'.$file->extension();
            $file->move(public_path('assets/document'), $name);
            $document[] = $name;
            }
        }
        $order->save();
        return redirect()->route('order-details', ['id' => $order->id]);
    }
    public function order_check($id){
        $all_project = Project::all();
        $all_supplier = Supplier::all();
        $order_info = MakeOrder::find($id);
        return view('backend.project.interior.order_check', compact('order_info', 'all_project', 'all_supplier'));
    }
    public function order_details($id){
        $order_info = MakeOrder::find($id);
        $supply_info = Supplier::find($order_info->supplier_id);
        return view('backend.project.interior.order_details', compact('order_info', 'supply_info'));
    }
    public function order_pdf($id){
        $order_info = MakeOrder::find($id);
        $supply_info = Supplier::find($order_info->supplier_id);
        $pdf = PDF::loadView('backend.project.interior.order_pdf', compact('order_info', 'supply_info'));   
        return $pdf->download('order-'.$order_info->invoice_number.'.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function show(MakeOrder $makeOrder)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MakeOrder  $makeOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(MakeOrder $makeOrder)
    {
        $all_project = Project::all();
        $all_supplier = Supplier::all();
        return view('backend.project.interior.edit_order', compact('all_project', 'all_supplier', 'makeOrder'));
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
        $order = MakeOrder::find($makeOrder->id);
        $order->project_id = $request->project_id;
        $order->supplier_id = $request->supplier_id;
        $names = [];
        if($request->name){
            foreach($request->name as $key => $value){
                if($value){
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
        }
        $order->name = json_encode($names);
        $quantities = [];
        if($request->quantity){
          foreach($request->quantity as $quantity){
              if($quantity){
                $quantities[] = $quantity;
              }            
            }
        }
        $order->quantity = json_encode($quantities);
        $order->save();
        return redirect()->route('order-details', ['id' => $order->id]);
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
