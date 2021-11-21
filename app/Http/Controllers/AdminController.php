<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){
        return view('backend.index');
    }
    public function profile(Request $request){
        return view('backend.profile');
    }
    public function settings(Request $request){
        return view('backend.settings');
    }
}
