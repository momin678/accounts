<?php

namespace App\Http\Controllers;

use App\Models\AdjustValue;
use Illuminate\Http\Request;

class AdjustValueController extends Controller
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
        $values = new AdjustValue;
        $values->project_id = $request->project_id;
        $values->amount = $request->amount;
        $values->description = $request->description;
        $values->date = date('Y-m-d');
        $values->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdjustValue  $adjustValue
     * @return \Illuminate\Http\Response
     */
    public function show(AdjustValue $adjustValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdjustValue  $adjustValue
     * @return \Illuminate\Http\Response
     */
    public function edit(AdjustValue $adjustValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdjustValue  $adjustValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdjustValue $adjustValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdjustValue  $adjustValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdjustValue $adjustValue)
    {
        //
    }
}
