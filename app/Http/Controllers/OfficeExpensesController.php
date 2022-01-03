<?php

namespace App\Http\Controllers;

use App\Models\OfficeExpenses;
use App\Models\Employee;
use App\Models\SupplyGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OfficeExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice_number = 'LN_'.time();
        $user_id = Auth::id();
        if($request->name){
            foreach($request->name as $key => $value){
                $goods= SupplyGoods::where('name', $value)->first();
                if($goods == null){
                    $supply_goods = new SupplyGoods;
                    $supply_goods->name= $value;
                    $supply_goods->description= $request->description[$key];
                    $supply_goods->save();
                }
                $expenses = new OfficeExpenses;
                $expenses->user_id = $user_id;
                $expenses->invoice_number = $invoice_number;
                $expenses->month = $request->month;
                $expenses->date = $request->date;
                $expenses->method = $request->method;
                $expenses->name = $value;
                $expenses->quantity = $request->quantity[$key];
                $expenses->amount = $request->amount[$key];
                $expenses->save();
            }
            flash()->overlay('You are now a Laracasts member!', 'Yay');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfficeExpenses  $officeExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(OfficeExpenses $officeExpenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfficeExpenses  $officeExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit(OfficeExpenses $officeExpenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfficeExpenses  $officeExpenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfficeExpenses $officeExpenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfficeExpenses  $officeExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfficeExpenses $officeExpenses)
    {
        //
    }
    public function search_expenses(Request $request){
        $expenses = OfficeExpenses::where('month', $request->month)->where('date', $request->date)->get();
        return view('backend.expenses.expenses_details', compact('expenses', 'request'));
    }
}
