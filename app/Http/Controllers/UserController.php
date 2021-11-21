<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return view('users.index');
    }
    public function profile(Request $request){
        return view('users.profile');
    }
    public function settings(Request $request){
        return view('users.settings');
    }
}
