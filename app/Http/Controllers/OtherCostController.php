<?php

namespace App\Http\Controllers;

use App\Models\OtherCost;
use App\Models\Project;
use App\Models\SupplyGoods;
use Illuminate\Http\Request;

class OtherCostController extends Controller
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
        return view('backend.project.interior.other_cost', compact('all_project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cost = new OtherCost;
        $cost->project_id = $request->project_id;
        $cost->date = date('Y-m-d');
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
        $cost->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OtherCost  $otherCost
     * @return \Illuminate\Http\Response
     */
    public function show(OtherCost $otherCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OtherCost  $otherCost
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherCost $otherCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OtherCost  $otherCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherCost $otherCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OtherCost  $otherCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherCost $otherCost)
    {
        //
    }
}
