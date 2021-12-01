<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Project;
use App\Models\SupplyGoods;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\MakeOrder;
use DB;
class CostController extends Controller
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
        return view('backend.project.interior.expenses', compact('all_project', 'all_supplier'));
    }
    public function supply_goods_search(Request $request)
    {
        $query = $request->get('term','');
        $supply_goods=\DB::table('supply_goods');
        if($request->type=='name'){
            $supply_goods->where('name','LIKE','%'.$query.'%');
        }
        if($request->type=='description'){
            $supply_goods->where('description','LIKE','%'.$query.'%');
        }
        $supply_goods=$supply_goods->get();        
        $data=array();
        foreach ($supply_goods as $goods) {
            $data[]=array('name'=>$goods->name, 'description'=>$goods->description);
        }
        if(count($data))
            return $data;
        else
            return ['name'=>'', 'description'=>''];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $cost = new Cost;
        $cost->project_id = $request->project_id;
        $cost->supplier_id = $request->supplier_id;
        $cost->date = date('Y-m-d');
        $cost->invoice_number = $request->invoice_number;
        $names = [];
        if($request->name){
          foreach($request->name as $key => $name){
              if($name){
                $goods= SupplyGoods::where('name', $name)->first();
                if($goods == null){
                    $supply_goods = new SupplyGoods;
                    $supply_goods->name= $name;
                    $supply_goods->save();
                    $names[] = $supply_goods->id;
                }else{
                    $names[] = $goods->id;
                }
              }
            }
        }
        $cost->name = json_encode($names);
        $quantities = [];
        if($request->quantity){
          foreach($request->quantity as $quantity){
              if($quantity){
                $quantities[] = $quantity;
              }                
            }
        }
        $cost->quantity = json_encode($quantities);
        $amounts = [];
        $total_amount = 0;
        if($request->amount){
            foreach($request->amount as $amount){
                if($amount){
                    $amounts[] = $amount;
                    $total_amount +=$amount;
                }
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
            $name = time().rand(100,999).'.'.$file->extension();
            $file->move(public_path('assets/document'), $name);
            $document[] = $name;
            }
        }
        $cost->document = json_encode($document);
        $complate = $cost->save();
        if($complate){
            $order_info = MakeOrder::find($request->order_id);
            $order_info->status = 1;
            $order_info->save();
        }
        return redirect()->route('make-order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function show(Cost $cost)
    {
        $cost_info = $cost;
        $project_info = Cost::find($cost->id)->project;
        $supplier_info = Cost::find($cost->id)->supplier;
        return view('backend.project.interior.cost_details', compact('cost_info','project_info', 'supplier_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function edit(Cost $cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cost $cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cost $cost)
    {
        //
    }
    public function spending(Request $request, $id){
        $projectID = $id;
        $all_cost = Cost::where('project_id', $id)->get();
        return view('backend.project.interior.cost', compact('projectID', 'all_cost'));
    }
}
