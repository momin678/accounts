<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_employees = Employee::all();
        return view('backend.employee.index', compact('all_employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation = $request->designation;
        $employee->qualification = $request->qualification;
        $employee->number = $request->number;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $document = [];
        if($request->hasfile('documents')){
            foreach($request->documents as $file){
                $name = rand(100, 999).time().'.'.$file->extension();
                $file->move(public_path('assets/document'), $name);
                $document[] = $name;
            }
        }
        $employee->documents = json_encode($document);
        $employee->save();
        return back()->with('success', 'Employee add successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('backend.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // dd($employee);
        $employee = Employee::find($employee->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation = $request->designation;
        $employee->qualification = $request->qualification;
        $employee->number = $request->number;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        $file = $request->file('documents');
        if($file != null){
            if($employee->documents){
                foreach(json_decode($employee->documents) as $file){
                    $image_path = public_path('assets/document').'/'.$file;
                    unlink($image_path);
                }
            }
            $document = [];
            foreach($request->documents as $file){
                $name = rand(100, 999).time().'.'.$file->extension();
                $file->move(public_path('assets/document'), $name);
                $document[] = $name;
            }
            $employee->documents = json_encode($document);
        }
        $employee->save();
        return back()->with('success', 'Employee update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        dd($employee);
    }
}
