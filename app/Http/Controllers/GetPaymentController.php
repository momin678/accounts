<?php

namespace App\Http\Controllers;

use App\Models\GetPayment;
use App\Models\Project;
use App\Models\Worker;
use App\Models\Supplier;
use Illuminate\Http\Request;

class GetPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_project = Project::all();
        $all_worker = Worker::all();
        $all_supplier = Supplier::all();
        return view('backend.project.interior.payment', compact('all_project', 'all_worker', 'all_supplier'));
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
        // dd($request);
        $payment = new GetPayment;
        $payment->project_id = $request->project_id;
        $payment->payment_date = $request->payment_date;
        $payment->amount = $request->amount;
        $payment->method = $request->method;
        $document = [];
        if($request->hasfile('document')){
          foreach($request->file('document') as $file){
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('assets/document'), $name);
            $document[] = $name;
            }
        }
        $payment->document = json_encode($document);
        $payment->description = $request->description;
        $payment->save();
        return back()->with('success', 'Project create successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function show(GetPayment $getPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(GetPayment $getPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetPayment $getPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetPayment $getPayment)
    {
        //
    }
    public function get_payment(Request $request, $id){
        $projectID = $id;
        $all_payment = GetPayment::where('project_id', $id)->get();
        return view('backend.project.interior.get_payment', compact('projectID', 'all_payment'));
    }
    public function spending(Request $request, $id){
        dd($id);
    }
}
