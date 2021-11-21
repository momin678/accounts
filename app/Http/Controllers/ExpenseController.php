<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Supplier;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
        if($request->type == "worker"){
            $worker = Worker::find($request->worker_supplier);
            $worker->payments = $worker->payments+$request->amount;
            $worker->save();
        }elseif($request->type == "supplier"){
            $supplier = Supplier::find($request->worker_supplier);
            $supplier->paid_amount = $supplier->paid_amount+$request->amount;
            $supplier->save();
        }
        $expense = new Expense;
        $expense->project_id = $request->project_id;
        $expense->type = $request->type;
        $expense->worker_supplier = $request->worker_supplier;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->method = $request->method;
        $document = [];
        if($request->hasfile('document')){
          foreach($request->file('document') as $file){
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('assets/document'), $name);
            $document[] = $name;
            }
        }
        $expense->document = json_encode($document);
        $expense->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
