<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function index(){
        return view('editor.login');
    }


    public function login(Request $request ){
        // dd($request->all()) ;
        if(Auth::guard('editor')->attempt(['email'=>$request->email,
        "password"=>$request->password])){
            return redirect()->route('editor.dashboard');
        } else {
            return redirect()->route('editor_login_form');
        }
    }


    public function dashboard(){
        return view('editor.dashboard');
    }
}
