<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function login(){
    	return view('login');
    }
    public function loginDo(){
    	//$post=request()->input('account');
    	$post=request()->except('_token');

    	dd($post);
    }
}
