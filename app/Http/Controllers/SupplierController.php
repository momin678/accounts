<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Returned;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_supplier = Supplier::all();
        $all_project = Project::all();
        return view('backend.project.interior.supplier', compact('all_project', 'all_supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_supplier = Supplier::all();
        $all_project = Project::all();
        return view('backend.project.interior.supplier_payment', compact('all_project', 'all_supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->shop = $request->shop;
        $supplier->phone = $request->phone;
        $supplier->location = $request->location;
        $supplier->description = $request->description;
        $supplier->save();
        return back()->with('success', 'Supplier create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $supplier_info = $supplier;
        $supply_value = Supplier::find($supplier->id)->supply_value;
        $make_payment = Supplier::find($supplier->id)->make_payment;
        $return_info = Returned::where('supplier_id', $supplier->id)->get();
        return view('backend.project.interior.supplier_details', compact('supplier_info', 'supply_value', 'make_payment', 'return_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
